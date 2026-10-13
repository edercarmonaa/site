<?php

namespace Tests\Unit;

use App\Services\CourseService;
use Tests\TestCase;

final class CourseServiceTest extends TestCase
{
    public function test_courses_are_sorted_by_year_and_have_github_urls(): void
    {
        $courses = app(CourseService::class)->all();

        $this->assertSame(2026, $courses->first()['year']);
        $courses->each(fn (array $course) => $this->assertMatchesRegularExpression('/^https:\/\/github\.com\//', $course['github_url']));
        $courses->each(fn (array $course) => $this->assertArrayHasKey('image', $course));
    }

    public function test_courses_can_be_paginated(): void
    {
        config(['courses.courses_per_page' => 1]);

        $courses = app(CourseService::class)->paginate(page: 2);

        $this->assertSame(1, $courses->perPage());
        $this->assertSame(2, $courses->currentPage());
        $this->assertSame(2, $courses->total());
        $this->assertSame(1, $courses->count());
        $this->assertStringContainsString('/courses', $courses->path());
    }
}
