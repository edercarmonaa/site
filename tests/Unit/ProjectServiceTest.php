<?php

namespace Tests\Unit;

use App\Services\ProjectService;
use Tests\TestCase;

final class ProjectServiceTest extends TestCase
{
    public function test_projects_are_sorted_by_year_and_have_github_urls(): void
    {
        $projects = app(ProjectService::class)->all();

        $this->assertSame(2026, $projects->first()['year']);
        $projects->each(fn (array $project) => $this->assertMatchesRegularExpression('/^https:\/\/github\.com\//', $project['github_url']));
        $projects->each(fn (array $project) => $this->assertArrayHasKey('image', $project));
    }

    public function test_projects_can_be_paginated(): void
    {
        config(['projects.projects_per_page' => 1]);

        $projects = app(ProjectService::class)->paginate(page: 2);

        $this->assertSame(1, $projects->perPage());
        $this->assertSame(2, $projects->currentPage());
        $this->assertSame(2, $projects->total());
        $this->assertSame(1, $projects->count());
        $this->assertStringContainsString('/projects', $projects->path());
    }
}
