@extends('layouts.app')

@section('content')
<section class="section">
    <div class="mx-auto max-w-6xl px-5 py-14">
        <h1 class="font-mono text-4xl font-bold text-zinc-950 dark:text-white">Proyectos</h1>
        <p class="mt-4 max-w-3xl text-zinc-600 dark:text-zinc-300">Estos son algunos de los ultimos proyectos en los que he trabajado, integrando desarrollo de software, bases de datos, automatizacion y soluciones web.</p>
        <div class="project-list mt-8">
            @foreach ($projects as $project)
                @include('pages.partials.project-card', ['project' => $project, 'variant' => 'list'])
            @endforeach
        </div>
    </div>
</section>
@endsection
