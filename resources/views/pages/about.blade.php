@extends('layouts.app')

@push('schema')
    <x-schema.person />
@endpush

@section('content')
<section class="section">
    <div class="mx-auto max-w-6xl px-5 py-14">
        <h1 class="font-mono text-4xl font-bold text-zinc-950 dark:text-white">Sobre mí</h1>
        <p class="mt-3 text-lg text-brand">Ingeniero de software</p>
        <div class="mt-8 grid gap-8 lg:grid-cols-[1.2fr_.8fr]">
            <div class="space-y-5 text-zinc-700 dark:text-zinc-300">
                <p>Creo soluciones web practicas y mantenibles, con especial interes en automatizacion, Linux, bases de datos y desarrollo de software orientado a resolver problemas reales.</p>
                <p>Mi trabajo combina criterio tecnico, claridad en la comunicacion y cuidado por la experiencia final. Me gusta construir herramientas que sean faciles de operar, documentar aprendizajes y convertir procesos complejos en sistemas mas simples.</p>
                <p>En KaredIt comparto proyectos, notas y guias que reflejan ese enfoque: aprender en publico, mejorar con disciplina y dejar rastros utiles para otros desarrolladores.</p>
            </div>
            <aside class="card">
                <h2 class="font-mono text-xl font-semibold">Perfil</h2>
                <p class="mt-3 text-sm text-zinc-600 dark:text-zinc-300">Eder Carmona | Software Developer</p>
                <a class="text-link mt-4 inline-block" href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
            </aside>
        </div>
        @php
            $skills = [
                'Backend' => ['C#', 'Spring Boot', 'PHP', 'Laravel'],
                'Bases de datos' => ['MySQL', 'PostgreSQL', 'Microsoft SQL Server'],
                'Cloud' => ['Azure', 'AWS'],
                'DevOps' => ['GitHub Actions'],
                'Herramientas' => ['Python', 'Git'],
            ];
            $certs = config('certifications');
        @endphp
        <section class="mt-14">
            <h2 class="section-title">Skills</h2>
            <div class="mt-6 grid gap-4 md:grid-cols-2">
                @foreach ($skills as $group => $items)
                    <article class="card">
                        <h3 class="font-mono font-semibold">{{ $group }}</h3>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($items as $item)
                                <span class="tag">{{ $item }}</span>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
        <section class="mt-14">
            <h2 class="section-title">Certificaciones</h2>
            <div class="mt-6 grid gap-4 md:grid-cols-2">
                @foreach ($certs as $certification)
                    @if ($certification['verification_url'])
                        <a
                            class="card block focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand"
                            href="{{ $certification['verification_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Verificar certificacion {{ $certification['name'] }}"
                        >
                            <h3 class="font-mono font-semibold">{{ $certification['name'] }}</h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ $certification['institution'] }} · {{ $certification['year'] }}</p>
                        </a>
                    @else
                        <article class="card">
                            <h3 class="font-mono font-semibold">{{ $certification['name'] }}</h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ $certification['institution'] }} · {{ $certification['year'] }}</p>
                        </article>
                    @endif
                @endforeach
            </div>
        </section>
    </div>
</section>
@endsection
