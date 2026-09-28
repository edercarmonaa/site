@extends('layouts.app')

@push('schema')
    <x-schema.blog-posting :post="$post" />
    <x-schema.breadcrumbs :items="[
        ['name' => 'Inicio', 'url' => route('home')],
        ['name' => 'Blog', 'url' => route('blog.index')],
        ['name' => $post['title'], 'url' => route('blog.show', $post['slug'])],
    ]" />
@endpush

@section('content')
<article class="section">
    <div class="mx-auto max-w-3xl px-5 py-8">
        <nav class="text-sm text-zinc-500" aria-label="Breadcrumb"><a class="text-link" href="{{ route('home') }}">Inicio</a> / <a class="text-link" href="{{ route('blog.index') }}">Blog</a> / {{ $post['title'] }}</nav>
        <header class="mt-8">
            <h1 class="font-mono text-4xl font-bold text-zinc-950 dark:text-white">{{ $post['title'] }}</h1>
            <div class="mt-4 flex flex-wrap gap-3 text-sm text-zinc-500 dark:text-zinc-400">
                <span>{{ config('site.author') }}</span>
                <time datetime="{{ $post['date']->toDateString() }}">{{ $post['date']->format('Y-m-d') }}</time>
                <span>{{ $post['category'] }}</span>
                <span>{{ $post['reading_time'] }} min de lectura</span>
            </div>
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($post['tags'] as $tag)
                    <span class="tag">{{ $tag }}</span>
                @endforeach
            </div>
        </header>
        @if ($post['toc'])
            <nav class="card mt-8" aria-label="Tabla de contenido">
                <h2 class="font-mono text-lg font-semibold">Tabla de contenido</h2>
                <ol class="mt-3 space-y-2 text-sm">
                    @foreach ($post['toc'] as $item)
                        <li class="{{ $item['level'] === 3 ? 'ml-4' : '' }}"><a class="text-link" href="#{{ $item['id'] }}">{{ $item['text'] }}</a></li>
                    @endforeach
                </ol>
            </nav>
        @endif
        <div class="prose-karedit mt-8">{!! $post['html'] !!}</div>
        <footer class="mt-12 border-t border-zinc-200 pt-8 dark:border-zinc-700">
            <h2 class="font-mono text-lg font-semibold">Compartir</h2>
            <div class="mt-4 flex flex-wrap gap-3">
                <a class="btn-secondary" target="_blank" rel="noopener noreferrer" href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post['slug'])) }}&text={{ urlencode($post['title']) }}">X/Twitter</a>
                <a class="btn-secondary" target="_blank" rel="noopener noreferrer" href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $post['slug'])) }}">LinkedIn</a>
                <a class="btn-secondary" target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post['slug'])) }}">Facebook</a>
                <button class="btn-secondary" type="button" data-copy-link="{{ route('blog.show', $post['slug']) }}">Copiar enlace</button>
            </div>
            <div class="mt-8 grid gap-3 sm:grid-cols-3">
                @if ($adjacent['previous'])<a class="text-link" href="{{ route('blog.show', $adjacent['previous']['slug']) }}">Post anterior</a>@else<span></span>@endif
                <a class="text-link" href="{{ route('blog.index') }}">Volver al blog</a>
                @if ($adjacent['next'])<a class="text-link sm:text-right" href="{{ route('blog.show', $adjacent['next']['slug']) }}">Post siguiente</a>@endif
            </div>
        </footer>
    </div>
</article>
@endsection
