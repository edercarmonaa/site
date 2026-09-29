@extends('layouts.app')

@push('schema')
    <x-schema.breadcrumbs :items="[
        ['name' => 'Inicio', 'url' => route('home')],
        ['name' => 'Blog', 'url' => route('blog.index')],
    ]" />
@endpush

@section('content')
<section class="section">
    <div class="mx-auto max-w-6xl px-5 py-8">
        <nav class="text-sm text-zinc-500" aria-label="Breadcrumb"><a class="text-link" href="{{ route('home') }}">Inicio</a> / Blog</nav>
        <h1 class="mt-8 font-mono text-4xl font-bold text-zinc-950 dark:text-white">Blog</h1>
        <p class="mt-4 max-w-3xl text-zinc-600 dark:text-zinc-300">Notas, guias y aprendizajes sobre tecnologia y desarrollo.</p>
    </div>
    <div class="sticky top-16 z-30 border-y border-zinc-200 bg-white/95 py-4 backdrop-blur dark:border-zinc-700 dark:bg-graphite/95">
        <div class="mx-auto max-w-6xl px-5">
            <label class="relative block">
                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-zinc-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                <input id="blog-search" class="input pl-10" type="search" placeholder="Buscar..." aria-label="Buscar publicaciones">
            </label>
            <div class="mt-3 flex flex-wrap gap-2" aria-label="Filtros de categoria">
                @foreach ($categories as $category)
                    <button class="filter-button" type="button" data-category-filter="{{ $category }}">{{ $category }}</button>
                @endforeach
                <button class="filter-button" type="button" data-clear-filters>Limpiar filtros</button>
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-6xl px-5 py-8">
        <div class="blog-list" data-post-list>
            @foreach ($posts as $post)
                @include('posts.partials.card', ['post' => $post])
            @endforeach
        </div>
        <p class="mt-8 hidden text-zinc-600 dark:text-zinc-300" data-no-results>No se encontraron publicaciones.</p>
        <div class="mt-8">{{ $posts->links() }}</div>
    </div>
</section>
@endsection
