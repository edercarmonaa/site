<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\ProjectService;
use App\Services\SeoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class PageController
{
    public function home(Request $request, PostService $posts, ProjectService $projects, SeoService $seo): View
    {
        return view('pages.home', [
            'latestPosts' => $posts->latest(),
            'latestProjects' => $projects->latest(),
            'seo' => $this->seo('Inicio | KaredIt', config('site.description'), $seo, $request),
        ]);
    }

    public function about(Request $request, SeoService $seo): View
    {
        return view('pages.about', ['seo' => $this->seo('Sobre mí | KaredIt', 'Sobre Eder Carmona, ingeniero de software.', $seo, $request)]);
    }

    public function projects(Request $request, ProjectService $projects, SeoService $seo): View
    {
        return view('pages.projects', ['projects' => $projects->all(), 'seo' => $this->seo('Proyectos | KaredIt', 'Proyectos de software, bases de datos y automatizacion.', $seo, $request)]);
    }

    public function privacy(Request $request, SeoService $seo): View
    {
        return view('pages.privacy', ['seo' => $this->seo('Privacidad | KaredIt', 'Aviso de privacidad general de KaredIt.', $seo, $request)]);
    }

    private function seo(string $title, string $description, SeoService $seo, Request $request): array
    {
        return [
            'title' => $title,
            'description' => $description,
            'canonical' => $seo->canonical($request),
            'robots' => $seo->robots($request),
        ];
    }
}
