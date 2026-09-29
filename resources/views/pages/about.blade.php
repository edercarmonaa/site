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
                <table class="min-w-[760px] w-full border-collapse text-left">
                    <caption class="sr-only">Listado de certificaciones profesionales</caption>
                    <tbody class="divide-y divide-zinc-200 border-y border-zinc-200 dark:divide-zinc-700 dark:border-zinc-700">
                        @foreach ($certs as $certification)
                            @php
                                $issuer = Str::contains($certification['institution'], 'Microsoft') ? 'microsoft' : (Str::contains($certification['institution'], 'Google') ? 'google' : 'default');
                            @endphp
                            <tr class="transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/45">
                                <td class="w-[48%] py-4 pl-4 pr-6">
                                    <div class="flex items-center gap-3">
                                        @if ($issuer === 'microsoft')
                                            <span class="grid h-7 w-7 shrink-0 grid-cols-2 gap-0.5" aria-hidden="true">
                                                <span class="block bg-[#f25022]"></span>
                                                <span class="block bg-[#7fba00]"></span>
                                                <span class="block bg-[#00a4ef]"></span>
                                                <span class="block bg-[#ffb900]"></span>
                                            </span>
                                        @elseif ($issuer === 'google')
                                            <span class="inline-flex h-7 w-7 shrink-0 items-center justify-center font-sans text-2xl font-bold text-[#4285f4]" aria-hidden="true">G</span>
                                        @else
                                            <span class="inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-zinc-400 font-mono text-xs font-bold text-white" aria-hidden="true">{{ Str::upper(Str::substr($certification['institution'], 0, 1)) }}</span>
                                        @endif
                                        <span class="font-semibold text-zinc-950 dark:text-white">{{ $certification['name'] }}</span>
                                    </div>
                                </td>
                                <td class="w-[40%] px-6 py-4 text-zinc-600 dark:text-zinc-300">{{ $certification['institution'] }} · {{ $certification['year'] }}</td>
                                <td class="w-[12%] py-4 pl-6 pr-4 text-right">
                                    @if ($certification['verification_url'])
                                        <a class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-zinc-500 hover:bg-zinc-100 hover:text-brand dark:hover:bg-zinc-800" href="{{ $certification['verification_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Verificar certificacion {{ $certification['name'] }}" title="Ver certificacion">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                                        </a>
                                    @else
                                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-zinc-300" aria-label="Sin enlace de verificacion">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                                        </span>
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
