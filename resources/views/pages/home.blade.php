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
                <article class="card fade-in flex h-full min-h-36 flex-col justify-between gap-5">
                    <span class="flex h-12 w-12 items-center justify-center rounded-lg border border-zinc-200 bg-zinc-50 text-zinc-800 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100" aria-hidden="true">
                        @switch($area)
                            @case('Backend & APIs')
                            @case('Desarrollo de software')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 15.5A3.5 3.5 0 1 0 12 8a3.5 3.5 0 0 0 0 7.5Z"/><path d="M19.4 15a1.8 1.8 0 0 0 .36 1.98l.06.06a2.1 2.1 0 0 1-2.97 2.97l-.06-.06a1.8 1.8 0 0 0-1.98-.36 1.8 1.8 0 0 0-1.08 1.65v.18a2.1 2.1 0 0 1-4.2 0v-.1A1.8 1.8 0 0 0 8.45 19.6a1.8 1.8 0 0 0-1.98.36l-.06.06a2.1 2.1 0 0 1-2.97-2.97l.06-.06A1.8 1.8 0 0 0 3.86 15a1.8 1.8 0 0 0-1.65-1.08h-.1a2.1 2.1 0 0 1 0-4.2h.1A1.8 1.8 0 0 0 3.86 8.6a1.8 1.8 0 0 0-.36-1.98l-.06-.06a2.1 2.1 0 0 1 2.97-2.97l.06.06a1.8 1.8 0 0 0 1.98.36h.02A1.8 1.8 0 0 0 9.55 2.4v-.1a2.1 2.1 0 0 1 4.2 0v.1a1.8 1.8 0 0 0 1.08 1.65 1.8 1.8 0 0 0 1.98-.36l.06-.06a2.1 2.1 0 0 1 2.97 2.97l-.06.06A1.8 1.8 0 0 0 19.42 8.6v.02A1.8 1.8 0 0 0 21 9.7h.1a2.1 2.1 0 0 1 0 4.2H21a1.8 1.8 0 0 0-1.6 1.1Z"/></svg>
                                @break
                            @case('Linux & SysAdmin')
                            @case('Linux')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 17 10 11 4 5"/><path d="M12 19h8"/></svg>
                                @break
                            @case('Bases de datos')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><ellipse cx="12" cy="5" rx="7" ry="3"/><path d="M5 5v6c0 1.66 3.13 3 7 3s7-1.34 7-3V5"/><path d="M5 11v6c0 1.66 3.13 3 7 3s7-1.34 7-3v-6"/></svg>
                                @break
                            @case('Automatización & Scripting')
                            @case('Tutoriales')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m8 9-4 3 4 3"/><path d="m16 9 4 3-4 3"/><path d="m14 5-4 14"/></svg>
                                @break
                            @default
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v18"/><path d="M3 12h18"/></svg>
                        @endswitch
                    </span>
                    <h3 class="font-mono text-lg font-semibold leading-snug">{{ $area }}</h3>
                </article>
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
                @include('posts.partials.card', ['post' => $post, 'variant' => 'home'])
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
<section class="section bg-zinc-50 dark:bg-zinc-900/30">
    <div class="mx-auto max-w-6xl px-5 py-14">
        <div class="section-heading">
            <h2 class="section-title">Ultimos cursos</h2>
            <a href="{{ route('courses') }}" class="text-link">Ver todos</a>
        </div>
        <div class="mt-6 grid gap-4 md:grid-cols-3">
            @foreach ($latestCourses as $course)
                @include('pages.partials.course-card', ['course' => $course])
            @endforeach
        </div>
    </div>
</section>
@endsection
