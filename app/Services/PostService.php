<?php

namespace App\Services;

use Carbon\CarbonImmutable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;
use Symfony\Component\Yaml\Yaml;

final class PostService
{
    public function __construct(private readonly ContentCache $cache)
    {
    }

    public function all(bool $publicOnly = true): Collection
    {
        $files = glob(config('blog.posts_path').'/*.md') ?: [];
        $posts = collect($files)->map(fn (string $path): array => $this->parseFile($path));
        $this->assertUniqueSlugs($posts);

        return $posts
            ->filter(fn (array $post): bool => ! $publicOnly || $post['is_public'])
            ->sortByDesc('date')
            ->values();
    }

    public function latest(int $limit = 3): Collection
    {
        return $this->all()->take($limit);
    }

    public function paginate(int $page = 1, bool $publicOnly = true): LengthAwarePaginator
    {
        $posts = $this->all($publicOnly);
        $perPage = (int) config('blog.posts_per_page');

        return new LengthAwarePaginator(
            $posts->forPage($page, $perPage)->values(),
            $posts->count(),
            $perPage,
            $page,
            ['path' => route('blog.index')]
        );
    }

    public function find(string $slug, bool $publicOnly = true): ?array
    {
        return $this->all($publicOnly)->firstWhere('slug', $slug);
    }

    public function adjacent(string $slug): array
    {
        $posts = $this->all();
        $index = $posts->search(fn (array $post): bool => $post['slug'] === $slug);

        return [
            'previous' => $index === false ? null : $posts->get($index + 1),
            'next' => $index === false ? null : $posts->get($index - 1),
        ];
    }

    private function parseFile(string $path): array
    {
        return $this->cache->rememberFile($path, function () use ($path): array {
            $raw = file_get_contents($path) ?: '';
            [$frontMatter, $markdown] = $this->splitFrontMatter($raw, $path);
            $meta = Yaml::parse($frontMatter) ?: [];
            $this->validateMeta($meta, $path);

            $slug = Str::of(basename($path, '.md'))->slug()->toString();
            $html = $this->markdownToHtml($markdown);
            $toc = $this->tableOfContents($html);
            $plain = trim(strip_tags($html));
            $date = CarbonImmutable::createFromFormat('Y-m-d', (string) $meta['date'])->startOfDay();
            $isDraft = (bool) ($meta['draft'] ?? false);
            $isFuture = $date->isFuture();
            $showRestricted = app()->environment(['local', 'testing']);

            return [
                'slug' => $slug,
                'title' => (string) $meta['title'],
                'date' => $date,
                'category' => (string) $meta['category'],
                'summary' => (string) $meta['summary'],
                'tags' => array_values($meta['tags']),
                'draft' => $isDraft,
                'future' => $isFuture,
                'status_label' => $isDraft ? 'Borrador' : ($isFuture ? 'Programado' : null),
                'canonical_url' => $meta['canonical_url'] ?? null,
                'html' => $html,
                'toc' => $toc,
                'reading_time' => max(1, (int) ceil(str_word_count($plain) / (int) config('blog.reading_words_per_minute'))),
                'is_public' => $showRestricted || (! $isDraft && ! $isFuture),
            ];
        });
    }

    private function splitFrontMatter(string $raw, string $path): array
    {
        if (! preg_match('/\A---\R(.*?)\R---\R(.*)\z/s', $raw, $matches)) {
            throw new InvalidArgumentException("El post {$path} no tiene front matter valido.");
        }

        return [$matches[1], $matches[2]];
    }

    private function validateMeta(array $meta, string $path): void
    {
        foreach (['title', 'date', 'category', 'summary', 'tags'] as $field) {
            if (! array_key_exists($field, $meta) || $meta[$field] === null || $meta[$field] === '') {
                throw new InvalidArgumentException("El post {$path} no define {$field}.");
            }
        }

        if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', (string) $meta['date'])) {
            throw new InvalidArgumentException("El post {$path} usa una fecha invalida.");
        }

        if (! in_array($meta['category'], config('blog.categories'), true)) {
            throw new InvalidArgumentException("El post {$path} usa una categoria no configurada.");
        }

        if (! is_array($meta['tags'])) {
            throw new InvalidArgumentException("El post {$path} debe definir tags como lista.");
        }
    }

    private function assertUniqueSlugs(Collection $posts): void
    {
        $duplicates = $posts->pluck('slug')->duplicates()->values();

        if ($duplicates->isNotEmpty()) {
            throw new InvalidArgumentException('Slugs duplicados: '.$duplicates->implode(', '));
        }
    }

    private function markdownToHtml(string $markdown): string
    {
        $environment = new Environment([
            'external_link' => [
                'internal_hosts' => [parse_url(config('site.url'), PHP_URL_HOST)],
                'open_in_new_window' => true,
                'html_class' => 'external-link',
                'noopener' => 'external',
                'noreferrer' => 'external',
            ],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new TableExtension);
        $environment->addExtension(new ExternalLinkExtension);

        $html = (new MarkdownConverter($environment))->convert($markdown)->getContent();
        $html = $this->addHeadingIds($html);

        return $this->enhanceImages($html);
    }

    private function addHeadingIds(string $html): string
    {
        return preg_replace_callback('/<h([23])>(.*?)<\/h\1>/i', function (array $match): string {
            $text = trim(strip_tags($match[2]));
            $id = Str::slug($text);

            return sprintf('<h%s id="%s">%s</h%s>', $match[1], e($id), $match[2], $match[1]);
        }, $html) ?? $html;
    }

    private function enhanceImages(string $html): string
    {
        return preg_replace_callback('/<img([^>]+)>/i', function (array $match): string {
            $tag = $match[0];
            $tag = str_contains($tag, 'loading=') ? $tag : str_replace('<img', '<img loading="lazy"', $tag);

            return str_replace('<img', '<img data-lightbox-image', $tag);
        }, $html) ?? $html;
    }

    private function tableOfContents(string $html): array
    {
        preg_match_all('/<h([23]) id="([^"]+)">(.*?)<\/h\1>/i', $html, $matches, PREG_SET_ORDER);

        return collect($matches)->map(fn (array $match): array => [
            'level' => (int) $match[1],
            'id' => $match[2],
            'text' => trim(strip_tags($match[3])),
        ])->all();
    }
}
