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
            <div class="mt-6 overflow-x-auto">
                <table class="min-w-[860px] w-full border-collapse text-left">
                    <caption class="sr-only">Listado de certificaciones profesionales</caption>
                    <tbody class="divide-y divide-zinc-200 border-y border-zinc-200 dark:divide-zinc-700 dark:border-zinc-700">
                        @foreach ($certs as $certification)
                            @php
                                $issuer = Str::contains($certification['institution'], 'Microsoft') ? 'microsoft' : (Str::contains($certification['institution'], 'Google') ? 'google' : 'default');
                            @endphp
                            <tr class="transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/45">
                                <td class="w-[40%] py-4 pl-4 pr-6">
                                    <div class="flex items-center gap-3">
                                        @if ($issuer === 'microsoft')
                                            <span class="certification-logo certification-logo-microsoft" aria-hidden="true">
                                                <span></span><span></span><span></span><span></span>
                                            </span>
                                        @elseif ($issuer === 'google')
                                            <span class="certification-logo certification-logo-google" aria-hidden="true">G</span>
                                        @else
                                            <span class="certification-logo certification-logo-default" aria-hidden="true">{{ Str::upper(Str::substr($certification['institution'], 0, 1)) }}</span>
                                        @endif
                                        <span class="font-semibold text-zinc-950 dark:text-white">{{ $certification['name'] }}</span>
                                    </div>
                                </td>
                                <td class="w-[16%] px-6 py-4">
                                    <span class="inline-flex rounded-full bg-cyan-50 px-3 py-1 font-mono text-xs font-semibold text-brand dark:bg-cyan-950/40">Certificación</span>
                                </td>
                                <td class="w-[28%] px-6 py-4 text-zinc-600 dark:text-zinc-300">{{ $certification['institution'] }} · {{ $certification['year'] }}</td>
                                <td class="w-[16%] py-4 pl-6 pr-4 text-right">
                                    @if ($certification['verification_url'])
                                        <a class="whitespace-nowrap font-semibold text-zinc-500 hover:text-brand" href="{{ $certification['verification_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Verificar certificacion {{ $certification['name'] }}">Learn more <span aria-hidden="true">→</span></a>
                                    @else
                                        <span class="whitespace-nowrap font-semibold text-zinc-400/70">Learn more <span aria-hidden="true">→</span></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</section>
@endsection
