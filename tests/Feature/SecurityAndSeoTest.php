<?php

namespace Tests\Feature;

use Tests\TestCase;

final class SecurityAndSeoTest extends TestCase
{
    public function test_security_headers_are_present(): void
    {
        $this->get('/')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'DENY')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_search_pages_are_noindex_and_canonical_excludes_query(): void
    {
        $this->get('/blog?search=ssh')
            ->assertOk()
            ->assertSee('noindex, follow')
            ->assertSee('https://karedit.com.mx/blog');
    }

    public function test_technical_rate_limit_returns_429(): void
    {
        for ($i = 0; $i < 11; $i++) {
            $response = $this->get('/_limited');
        }

        $response->assertStatus(429);
    }
}
