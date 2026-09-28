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
