<!doctype html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-seo.meta :seo="$seo ?? []" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script>
        const savedTheme = localStorage.getItem('karedit-theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        document.documentElement.classList.toggle('dark', savedTheme ? savedTheme === 'dark' : prefersDark);
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { colors: { brand: '#00a2c2', graphite: '#2f2f35' }, fontFamily: { sans: ['Roboto', 'sans-serif'], mono: ['JetBrains Mono', 'monospace'] } } } };
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-tomorrow.min.css">
    <link rel="stylesheet" href="/assets/css/site.css">
    <link rel="manifest" href="/manifest.webmanifest">
    <link rel="icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32x32.png">
    <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">
    @stack('schema')
</head>
<body class="bg-white text-zinc-800 antialiased transition-colors duration-200 dark:bg-graphite dark:text-zinc-100">
    <a href="#contenido" class="skip-link">Saltar al contenido</a>
    <header class="fixed inset-x-0 top-0 z-50 border-b border-zinc-200/70 bg-white/80 backdrop-blur dark:border-zinc-700/70 dark:bg-graphite/80">
        <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between px-5" aria-label="Navegacion principal">
            <a href="{{ route('home') }}" aria-label="KaredIt inicio" class="inline-flex items-center rounded-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand">
                <img src="{{ config('site.logo_light') }}" alt="KaredIt" class="h-10 w-auto dark:hidden">
                <img src="{{ config('site.logo_dark') }}" alt="KaredIt" class="hidden h-10 w-auto dark:block">
            </a>
            @php
                $items = [
                    ['label' => 'Inicio', 'route' => 'home', 'active' => request()->routeIs('home')],
                    ['label' => 'Sobre mí', 'route' => 'about', 'active' => request()->routeIs('about')],
                    ['label' => 'Proyectos', 'route' => 'projects', 'active' => request()->routeIs('projects')],
                    ['label' => 'Blog', 'route' => 'blog.index', 'active' => request()->routeIs('blog.*')],
                ];
            @endphp
            <div class="hidden items-center gap-1 md:flex">
                @foreach ($items as $item)
                    <a href="{{ route($item['route']) }}" class="nav-link {{ $item['active'] ? 'active' : '' }}">{{ $item['label'] }}</a>
                @endforeach
                <button type="button" class="icon-button ml-2" data-theme-toggle aria-label="Cambiar modo claro u oscuro">
                    <span class="theme-icon-light" aria-hidden="true">☀</span>
                    <span class="theme-icon-dark" aria-hidden="true">☾</span>
                </button>
            </div>
            <div class="flex items-center gap-2 md:hidden">
                <button type="button" class="icon-button" data-theme-toggle aria-label="Cambiar modo claro u oscuro"><span aria-hidden="true">☾</span></button>
                <button type="button" class="icon-button" data-menu-button aria-label="Abrir menu" aria-expanded="false" aria-controls="mobile-menu">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </nav>
        <div id="mobile-menu" class="hidden border-t border-zinc-200 bg-white px-5 py-3 dark:border-zinc-700 dark:bg-graphite md:hidden">
            @foreach ($items as $item)
                <a href="{{ route($item['route']) }}" class="mobile-nav-link {{ $item['active'] ? 'active' : '' }}">{{ $item['label'] }}</a>
            @endforeach
        </div>
    </header>
    <main id="contenido" tabindex="-1" class="pt-16 outline-none">
        @yield('content')
    </main>
    <footer class="border-t border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900/40">
        <div class="mx-auto flex max-w-6xl flex-col gap-5 px-5 py-8 md:flex-row md:items-center md:justify-between">
            <img src="{{ config('site.logo_footer') }}" alt="KaredIt" class="h-8 w-auto">
            <div class="flex flex-wrap items-center gap-4 text-sm">
                <a class="footer-link" href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
                @foreach (config('site.social') as $name => $url)
                    @if ($url)
                        <a class="footer-link" href="{{ $url }}" target="_blank" rel="noopener noreferrer">{{ ucfirst($name) }}</a>
                    @endif
                @endforeach
            </div>
            <p class="text-sm text-zinc-600 dark:text-zinc-300">© 2026 KaredIt. Desarrollado por Eder Carmona.</p>
        </div>
    </footer>
    <div data-lightbox class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/80 p-4" role="dialog" aria-modal="true">
        <button type="button" data-lightbox-close class="absolute right-4 top-4 text-white" aria-label="Cerrar imagen">Cerrar</button>
        <img src="" alt="" class="max-h-full max-w-full rounded-lg">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-bash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-php.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-json.min.js"></script>
    <script src="/assets/js/site.js" defer></script>
</body>
</html>
