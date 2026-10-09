@extends('layouts.app')

@section('content')
<section class="section">
    <div class="mx-auto max-w-6xl px-5 py-14">
        <h1 class="font-mono text-4xl font-bold text-zinc-950 dark:text-white">Cursos</h1>
        <p class="mt-4 max-w-3xl text-zinc-600 dark:text-zinc-300">Estos son algunos cursos, guias y repositorios educativos enfocados en aprendizaje practico, desarrollo de software y tecnologia aplicada.</p>
        <div class="mt-8 grid gap-5 lg:grid-cols-2">
            @foreach ($courses as $course)
                @include('pages.partials.course-card', ['course' => $course, 'variant' => 'feature'])
            @endforeach
        </div>
    </div>
</section>
@endsection
