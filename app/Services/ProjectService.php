<?php

namespace App\Services;

use Illuminate\Support\Collection;
use InvalidArgumentException;

final class ProjectService
{
    public function __construct(private readonly ContentCache $cache)
    {
    }

    public function all(): Collection
    {
        $path = config('projects.path');

        return $this->cache->rememberFile($path, function () use ($path): Collection {
            $decoded = json_decode(file_get_contents($path) ?: '[]', true);

            if (! is_array($decoded)) {
                throw new InvalidArgumentException('projects.json no contiene JSON valido.');
            }

            return collect($decoded)
                ->map(fn (array $project): array => $this->validate($project))
                ->sortByDesc('year')
                ->values();
        });
    }

    public function latest(int $limit = 3): Collection
    {
        return $this->all()->take($limit);
    }

    private function validate(array $project): array
    {
        foreach (['name', 'description', 'technologies', 'year', 'github_url'] as $field) {
            if (! array_key_exists($field, $project)) {
                throw new InvalidArgumentException("Proyecto sin campo {$field}.");
            }
        }

        if (! is_array($project['technologies'])) {
            throw new InvalidArgumentException('Las tecnologias del proyecto deben ser una lista.');
        }

        if (! filter_var($project['github_url'], FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Cada proyecto debe tener una URL de GitHub valida.');
        }

        return $project;
    }
}
