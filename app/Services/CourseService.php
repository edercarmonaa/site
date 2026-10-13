<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use InvalidArgumentException;

final class CourseService
{
    public function __construct(private readonly ContentCache $cache)
    {
    }

    public function all(): Collection
    {
        $path = config('courses.path');

        return $this->cache->rememberFile($path, function () use ($path): Collection {
            $decoded = json_decode(file_get_contents($path) ?: '[]', true);

            if (! is_array($decoded)) {
                throw new InvalidArgumentException('courses.json no contiene JSON valido.');
            }

            return collect($decoded)
                ->map(fn (array $course): array => $this->validate($course))
                ->sortByDesc('year')
                ->values();
        });
    }

    public function latest(int $limit = 3): Collection
    {
        return $this->all()->take($limit);
    }

    public function paginate(int $page = 1): LengthAwarePaginator
    {
        $courses = $this->all();
        $perPage = (int) config('courses.courses_per_page');

        return new LengthAwarePaginator(
            $courses->forPage($page, $perPage)->values(),
            $courses->count(),
            $perPage,
            $page,
            ['path' => route('courses')]
        );
    }

    private function validate(array $course): array
    {
        foreach (['name', 'description', 'technologies', 'year', 'github_url'] as $field) {
            if (! array_key_exists($field, $course)) {
                throw new InvalidArgumentException("Curso sin campo {$field}.");
            }
        }

        if (! is_array($course['technologies'])) {
            throw new InvalidArgumentException('Las tecnologias del curso deben ser una lista.');
        }

        if (! filter_var($course['github_url'], FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Cada curso debe tener una URL de GitHub valida.');
        }

        $course['image'] = $course['image'] ?? null;

        if ($course['image'] !== null && (! is_string($course['image']) || ! str_starts_with($course['image'], '/assets/img/'))) {
            throw new InvalidArgumentException('La imagen del curso debe ser null o una ruta publica dentro de /assets/img/.');
        }

        return $course;
    }
}
