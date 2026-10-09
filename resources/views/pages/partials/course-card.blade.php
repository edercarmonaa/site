@php($variant = $variant ?? 'card')

@if ($variant === 'feature')
    <article class="project-feature-card fade-in">
        <div class="flex items-start gap-5">
            <div class="project-feature-icon" aria-hidden="true">
                <svg class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 19.5V5.75A2.75 2.75 0 0 1 6.75 3H20v15H6.75A2.75 2.75 0 0 0 4 20.75"/><path d="M8 7h8"/><path d="M8 11h6"/></svg>
            </div>
            <div class="min-w-0">
                <p class="font-mono text-sm font-semibold text-brand">{{ $course['year'] }}</p>
                <h2 class="mt-2 text-2xl font-semibold text-zinc-950 dark:text-white">{{ $course['name'] }}</h2>
                <p class="mt-3 leading-7 text-zinc-600 dark:text-zinc-300">{{ $course['description'] }}</p>
            </div>
        </div>
        <div class="project-feature-panel">
            @if ($course['image'])
                <img src="{{ $course['image'] }}" alt="Vista previa de {{ $course['name'] }}" loading="lazy" class="project-feature-image" width="720" height="420">
            @else
                <div aria-hidden="true" class="w-full">
                    <div class="project-feature-window">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="space-y-3 font-mono text-xs text-zinc-500 dark:text-zinc-400">
                        <div class="h-3 w-3/4 rounded bg-zinc-200 dark:bg-zinc-700"></div>
                        <div class="h-3 w-1/2 rounded bg-zinc-200 dark:bg-zinc-700"></div>
                        <div class="h-3 w-2/3 rounded bg-zinc-200 dark:bg-zinc-700"></div>
                    </div>
                </div>
            @endif
        </div>
        <div class="mt-5 flex flex-wrap gap-2">
            @foreach ($course['technologies'] as $technology)
                <span class="tag tag-subtle">{{ $technology }}</span>
            @endforeach
        </div>
        <a href="{{ $course['github_url'] }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex text-sm font-semibold text-brand hover:text-cyan-700">Ver curso</a>
    </article>
@else
    <article class="card fade-in">
        <div class="flex items-start justify-between gap-4">
            <h2 class="font-mono text-xl font-semibold">{{ $course['name'] }}</h2>
            <span class="font-mono text-sm text-brand">{{ $course['year'] }}</span>
        </div>
        <div class="mt-4 flex h-12 w-12 items-center justify-center rounded-lg border border-zinc-200 bg-zinc-50 text-zinc-800 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100" aria-hidden="true">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 19.5V5.75A2.75 2.75 0 0 1 6.75 3H20v15H6.75A2.75 2.75 0 0 0 4 20.75"/><path d="M8 7h8"/><path d="M8 11h6"/></svg>
        </div>
        <p class="mt-3 text-zinc-600 dark:text-zinc-300">{{ $course['description'] }}</p>
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach ($course['technologies'] as $technology)
                <span class="tag">{{ $technology }}</span>
            @endforeach
        </div>
        <a href="{{ $course['github_url'] }}" target="_blank" rel="noopener noreferrer" class="btn-secondary mt-5 inline-flex">Ver curso</a>
    </article>
@endif
