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
            $certs = [
                ['Google Business Intelligence Certificate', 'Google / Coursera', '2024'],
                ['Microsoft Certified: Azure Data Fundamentals', 'Microsoft', '2025'],
                ['Certificado de Ciberseguridad', 'Google / Coursera', '2024'],
                ['Google IT Automation with Python Professional Certificate', 'Google / Coursera', '2023'],
                ['Certificado de Soporte de TI', 'Google / Coursera', '2023'],
                ['Certificado de Analisis de Datos', 'Google / Coursera', '2022'],
                ['Microsoft Certified: Azure Fundamentals', 'Microsoft', '2022'],
            ];
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
                @foreach ($certs as [$name, $institution, $year])
                    <article class="card">
                        <h3 class="font-mono font-semibold">{{ $name }}</h3>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ $institution }} · {{ $year }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
</section>
@endsection
