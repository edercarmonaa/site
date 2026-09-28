<?php

namespace Tests\Unit;

use App\Services\PostService;
use Tests\TestCase;

final class PostServiceTest extends TestCase
{
    public function test_posts_are_sorted_and_have_reading_time_and_toc(): void
    {
        $posts = app(PostService::class)->all();
        $first = $posts->first();

        $this->assertSame('instalar-ssh-debian', $first['slug']);
        $this->assertGreaterThanOrEqual(1, $first['reading_time']);
        $this->assertNotEmpty($first['toc']);
    }

    public function test_front_matter_categories_are_configured(): void
    {
        $categories = app(PostService::class)->all(publicOnly: false)->pluck('category')->unique();

        $categories->each(fn (string $category) => $this->assertContains($category, config('blog.categories')));
    }
}
