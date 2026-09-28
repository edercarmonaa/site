<?php

namespace Tests\Feature;

use Tests\TestCase;

final class SpecificationCoverageTest extends TestCase
{
    public function test_configured_error_pages_render_supported_statuses(): void
    {
        foreach ([400, 401, 403, 404, 429, 500, 503] as $status) {
            $this->get("/_error/{$status}")
                ->assertStatus($status)
                ->assertSee(config("errors.pages.{$status}.title"));
        }

        $this->get('/_method-only')
            ->assertStatus(405)
            ->assertSee('ERROR 405 - METHOD NOT ALLOWED');
    }

    public function test_manifest_icons_and_theme_assets_are_declared(): void
    {
        $this->get('/manifest.webmanifest')
            ->assertOk()
            ->assertSee('KaredIt')
            ->assertSee('icon-192x192.png')
            ->assertSee('icon-512x512.png');

        $this->get('/')
            ->assertOk()
            ->assertSee('prefers-color-scheme')
            ->assertSee('prefers-reduced-motion')
            ->assertSee('Saltar al contenido')
            ->assertSee('aria-expanded')
            ->assertSee('logo-light.png')
            ->assertSee('logo-dark.png');
    }

    public function test_blog_ui_contains_search_filters_copy_share_and_lightbox_hooks(): void
    {
        $this->get('/blog')
            ->assertOk()
            ->assertSee('Buscar...')
            ->assertSee('Limpiar filtros')
            ->assertSee('No se encontraron publicaciones.');

        $this->get('/blog/instalar-ssh-debian')
            ->assertOk()
            ->assertSee('data-copy-link')
            ->assertSee('Copiar enlace')
            ->assertSee('data-lightbox');
    }
}
