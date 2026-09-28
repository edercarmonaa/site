<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\ProjectService;
use Illuminate\Http\Response;

final class SitemapController
{
    public function __invoke(PostService $posts, ProjectService $projects): Response
    {
        $urls = collect(['/', '/about', '/projects', '/blog', '/privacy'])
            ->map(fn (string $path): string => rtrim(config('site.url'), '/').$path)
            ->merge($posts->all()->map(fn (array $post): string => route('blog.show', $post['slug'])))
            ->merge($projects->all()->map(fn (): string => route('projects')))
            ->unique()
            ->values();

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
