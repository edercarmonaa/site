<?php

namespace Tests\Feature;

use Tests\TestCase;

final class CertificationLinksTest extends TestCase
{
    public function test_certification_learn_more_links_open_verification_urls_in_new_tabs(): void
    {
        config()->set('certifications.0.verification_url', 'https://example.com/certification');

        $this->get('/about')
            ->assertOk()
            ->assertSee('href="https://example.com/certification"', false)
            ->assertSee('target="_blank"', false)
            ->assertSee('rel="noopener noreferrer"', false)
            ->assertSee('Learn more', false)
            ->assertSee('aria-label="Verificar certificacion Google Business Intelligence Certificate"', false);
    }
}
