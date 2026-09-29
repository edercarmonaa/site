@php($variant = $variant ?? 'card')

@if ($variant === 'list')
    <article class="project-entry fade-in">
        <div class="project-entry-year">
            <span>{{ $project['year'] }}</span>
        </div>
        <div class="project-entry-body">
            <h2 class="text-xl font-semibold text-zinc-950 dark:text-white">{{ $project['name'] }}</h2>
            <p class="mt-4 max-w-3xl leading-7 text-zinc-600 dark:text-zinc-300">{{ $project['description'] }}</p>
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($project['technologies'] as $technology)
                    <span class="tag tag-subtle">{{ $technology }}</span>
                @endforeach
            </div>
            <a href="{{ $project['github_url'] }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex text-sm font-semibold text-brand hover:text-cyan-700">Ver codigo</a>
        </div>
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
