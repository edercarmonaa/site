<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\SeoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class BlogController
{
    public function index(Request $request, PostService $posts, SeoService $seo): View
    {
        return view('posts.index', [
            'posts' => $posts->paginate((int) $request->query('page', 1)),
            'categories' => config('blog.categories'),
            'seo' => [
                'title' => 'Blog | KaredIt',
                'description' => 'Notas, guias y aprendizajes sobre tecnologia y desarrollo.',
                'canonical' => $seo->canonical($request),
                'robots' => $seo->robots($request),
            ],
        ]);
    }

    public function show(string $slug, Request $request, PostService $posts, SeoService $seo): View
    {
        $post = $posts->find($slug);

        if (! $post) {
            throw new NotFoundHttpException;
        }

        return view('posts.show', [
            'post' => $post,
            'adjacent' => $posts->adjacent($slug),
            'seo' => [
                'title' => $post['title'].' | KaredIt',
                'description' => $post['summary'],
                'canonical' => $seo->canonical($request, $post['canonical_url']),
                'robots' => $seo->robots($request),
            ],
        ]);
    }
}
