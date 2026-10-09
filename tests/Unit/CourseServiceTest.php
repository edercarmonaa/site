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
}
