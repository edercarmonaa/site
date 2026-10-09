@php($variant = $variant ?? 'card')

@if ($variant === 'feature')
    <article class="project-feature-card fade-in">
        <div class="flex items-start gap-5">
            <div class="project-feature-icon" aria-hidden="true">
                <svg class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m8 9-4 3 4 3"/><path d="m16 9 4 3-4 3"/><path d="m14 5-4 14"/></svg>
            </div>
            <div class="min-w-0">
                <p class="font-mono text-sm font-semibold text-brand">{{ $project['year'] }}</p>
                <h2 class="mt-2 text-2xl font-semibold text-zinc-950 dark:text-white">{{ $project['name'] }}</h2>
                <p class="mt-3 leading-7 text-zinc-600 dark:text-zinc-300">{{ $project['description'] }}</p>
            </div>
        </div>
        <div class="project-feature-panel">
            @if ($project['image'])
                <img src="{{ $project['image'] }}" alt="Vista previa de {{ $project['name'] }}" loading="lazy" class="project-feature-image" style="width: 100%; height: auto; object-fit: contain; object-position: center;">
            @else
                <div aria-hidden="true">
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
            @foreach ($project['technologies'] as $technology)
                <span class="tag tag-subtle">{{ $technology }}</span>
            @endforeach
        </div>
        <a href="{{ $project['github_url'] }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex text-sm font-semibold text-brand hover:text-cyan-700">Ver codigo</a>
    </article>
@else
    <article class="card fade-in">
        <div class="flex items-start justify-between gap-4">
            <h2 class="font-mono text-xl font-semibold">{{ $project['name'] }}</h2>
            <span class="font-mono text-sm text-brand">{{ $project['year'] }}</span>
        </div>
        <p class="mt-3 text-zinc-600 dark:text-zinc-300">{{ $project['description'] }}</p>
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach ($project['technologies'] as $technology)
                <span class="tag">{{ $technology }}</span>
            @endforeach
        </div>
        <a href="{{ $project['github_url'] }}" target="_blank" rel="noopener noreferrer" class="btn-secondary mt-5 inline-flex">Ver codigo</a>
    </article>
@endif
