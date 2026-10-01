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
                        <a class="footer-social-link" href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($name) }}">
                            @switch($name)
                                @case('github')
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 .5a12 12 0 0 0-3.79 23.39c.6.11.82-.26.82-.58v-2.03c-3.34.73-4.04-1.61-4.04-1.61-.55-1.39-1.34-1.76-1.34-1.76-1.09-.75.08-.73.08-.73 1.2.08 1.84 1.24 1.84 1.24 1.07 1.83 2.81 1.3 3.49.99.11-.78.42-1.3.76-1.6-2.67-.3-5.47-1.34-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.12-.3-.54-1.52.12-3.18 0 0 1.01-.32 3.3 1.23A11.47 11.47 0 0 1 12 5.8c1.02 0 2.04.14 3 .4 2.29-1.55 3.3-1.23 3.3-1.23.66 1.66.24 2.88.12 3.18.77.84 1.24 1.91 1.24 3.22 0 4.61-2.81 5.62-5.48 5.92.43.37.81 1.1.81 2.22v3.29c0 .32.22.7.83.58A12 12 0 0 0 12 .5Z"/></svg>
                                    @break
                                @case('linkedin')
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.86 0-2.14 1.45-2.14 2.95v5.66H9.34V9h3.42v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.61 0 4.27 2.37 4.27 5.46v6.28ZM5.32 7.43a2.06 2.06 0 1 1 0-4.13 2.06 2.06 0 0 1 0 4.13Zm1.78 13.02H3.54V9H7.1v11.45ZM22.23 0H1.77C.8 0 0 .77 0 1.72v20.56C0 23.23.8 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.2 0 22.23 0Z"/></svg>
                                    @break
                                @case('x')
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.9 2h3.68l-8.04 9.19L24 22h-7.41l-5.8-7.59L4.15 22H.47l8.6-9.83L0 2h7.6l5.24 6.93L18.9 2Zm-1.29 18.1h2.04L6.49 3.8H4.3l13.31 16.3Z"/></svg>
                                    @break
                                @case('instagram')
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7.8 2h8.4A5.8 5.8 0 0 1 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8A5.8 5.8 0 0 1 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2Zm0 2A3.8 3.8 0 0 0 4 7.8v8.4A3.8 3.8 0 0 0 7.8 20h8.4a3.8 3.8 0 0 0 3.8-3.8V7.8A3.8 3.8 0 0 0 16.2 4H7.8Zm8.7 1.55a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/></svg>
                                    @break
                                @case('facebook')
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.03 1.79-4.7 4.53-4.7 1.31 0 2.68.24 2.68.24v2.96h-1.51c-1.49 0-1.96.93-1.96 1.89v2.27h3.33l-.53 3.49h-2.8V24C19.61 23.1 24 18.1 24 12.07Z"/></svg>
                                    @break
                                @case('youtube')
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.2a3.02 3.02 0 0 0-2.13-2.13C19.5 3.56 12 3.56 12 3.56s-7.5 0-9.37.51A3.02 3.02 0 0 0 .5 6.2 31.45 31.45 0 0 0 0 12a31.45 31.45 0 0 0 .5 5.8 3.02 3.02 0 0 0 2.13 2.13c1.87.51 9.37.51 9.37.51s7.5 0 9.37-.51a3.02 3.02 0 0 0 2.13-2.13c.5-1.88.5-5.8.5-5.8s0-3.92-.5-5.8ZM9.55 15.59V8.41L15.82 12l-6.27 3.59Z"/></svg>
                                    @break
                                @default
                                    <span aria-hidden="true">{{ strtoupper(substr($name, 0, 1)) }}</span>
                            @endswitch
                            <span class="sr-only">{{ ucfirst($name) }}</span>
                        </a>
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
