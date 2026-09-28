@extends('layouts.app')

@push('schema')
    <x-schema.website />
    <x-schema.person />
@endpush

@section('content')
<section class="section bg-zinc-50 dark:bg-zinc-900/30">
    <div class="mx-auto grid max-w-6xl gap-8 px-5 py-16 md:grid-cols-[1fr_auto] md:items-center">
        <div class="fade-in">
            <img src="{{ config('site.logo_light') }}" alt="KaredIt" class="mb-8 h-24 w-auto dark:hidden">
            <img src="{{ config('site.logo_dark') }}" alt="KaredIt" class="mb-8 hidden h-24 w-auto dark:block">
            <h1 class="font-mono text-4xl font-bold tracking-normal text-zinc-950 dark:text-white md:text-5xl">KaredIt: portafolio, blog y guias</h1>
            <p class="mt-5 max-w-2xl text-lg text-zinc-600 dark:text-zinc-300">Un espacio personal para compartir y aprender.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('projects') }}" class="btn-primary">Ver proyectos</a>
                <a href="{{ route('blog.index') }}" class="btn-secondary">Leer blog</a>
            </div>
            <div class="mt-8 flex flex-wrap gap-2" aria-label="Temas rapidos">
                @foreach (config('site.quick_chips') as $chip)
                    <span class="tag">{{ $chip }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="mx-auto max-w-6xl px-5 py-14">
        <h2 class="section-title">Areas</h2>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach (config('site.areas') as $area)
                <article class="card fade-in"><h3 class="font-mono text-lg font-semibold">{{ $area }}</h3></article>
            @endforeach
        </div>
    </div>
</section>
<section class="section bg-zinc-50 dark:bg-zinc-900/30">
    <div class="mx-auto max-w-6xl px-5 py-14">
        <div class="section-heading">
            <h2 class="section-title">Ultimos posts</h2>
            <a href="{{ route('blog.index') }}" class="text-link">Ver todos</a>
        </div>
        <div class="mt-6 grid gap-4">
            @foreach ($latestPosts as $post)
                @include('posts.partials.card', ['post' => $post])
            @endforeach
        </div>
    </div>
</section>
<section class="section">
    <div class="mx-auto max-w-6xl px-5 py-14">
        <div class="section-heading">
            <h2 class="section-title">Ultimos proyectos</h2>
            <a href="{{ route('projects') }}" class="text-link">Ver todos</a>
        </div>
        <div class="mt-6 grid gap-4 md:grid-cols-3">
            @foreach ($latestProjects as $project)
                @include('pages.partials.project-card', ['project' => $project])
            @endforeach
        </div>
    </div>
</section>
@endsection
