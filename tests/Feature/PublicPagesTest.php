<?php

namespace Tests\Feature;

use Tests\TestCase;

final class PublicPagesTest extends TestCase
{
    public function test_public_pages_render_successfully(): void
    {
        foreach (['/', '/about', '/projects', '/blog', '/privacy'] as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_blog_post_renders_with_metadata(): void
    {
        $this->get('/blog/instalar-ssh-debian')
            ->assertOk()
            ->assertSee('Instalar y habilitar SSH en Debian')
            ->assertSee('Tabla de contenido')
            ->assertSee('twitter:card', false)
            ->assertSee('application/ld+json', false);
    }

    public function test_not_found_uses_custom_error_page(): void
    {
        $this->get('/no-existe')
            ->assertStatus(404)
            ->assertSee('ERROR 404 - NOT FOUND');
    }

    public function test_sitemap_and_robots_are_available(): void
    {
        $this->get('/sitemap.xml')->assertOk()->assertSee('https://karedit.com.mx/blog/instalar-ssh-debian');
        $this->get('/robots.txt')->assertOk()->assertSee('Sitemap: https://karedit.com.mx/sitemap.xml');
    }
}
