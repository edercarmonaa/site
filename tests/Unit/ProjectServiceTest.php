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
    }
}
