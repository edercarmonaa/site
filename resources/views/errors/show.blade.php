@php
    $page = config("errors.pages.{$status}");
    $isMaintenance = (int) $status === 503;
@endphp
<!doctype html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error {{ $status }} | KaredIt</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="{{ config('site.url') }}/">
    <script>
        const savedTheme = localStorage.getItem('karedit-theme');
        document.documentElement.classList.toggle('dark', savedTheme ? savedTheme === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches);
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class', theme: { extend: { colors: { brand: '#00a2c2', graphite: '#2f2f35' }, fontFamily: { mono: ['JetBrains Mono', 'monospace'], sans: ['Roboto', 'sans-serif'] } } } };</script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-white font-sans text-zinc-800 dark:bg-graphite dark:text-white">
    <main class="flex min-h-screen items-center justify-center px-5">
        <section class="text-center">
            <img src="{{ config('site.logo_light') }}" alt="KaredIt" class="mx-auto h-12 w-auto dark:hidden">
            <img src="{{ config('site.logo_dark') }}" alt="KaredIt" class="mx-auto hidden h-12 w-auto dark:block">
            <h1 class="mt-8 font-mono text-6xl font-bold text-brand">{{ $status }}</h1>
            <p class="mt-4 font-mono text-lg">{{ $page['title'] }}</p>
            <p class="mx-auto mt-3 max-w-md text-sm text-zinc-600 dark:text-zinc-300">{{ $page['description'] }}</p>
            @unless ($isMaintenance)
                <a href="{{ route('home') }}" title="Volver al inicio" aria-label="Volver al inicio" class="mx-auto mt-8 inline-flex h-11 w-11 items-center justify-center rounded-full bg-brand text-white hover:bg-cyan-700">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M10 20v-6h4v6"/></svg>
                </a>
            @endunless
        </section>
    </main>
</body>
</html>
