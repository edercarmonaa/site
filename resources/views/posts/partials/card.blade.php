<article class="card fade-in" data-post-card data-title="{{ Str::lower($post['title']) }}" data-summary="{{ Str::lower($post['summary']) }}" data-category="{{ Str::lower($post['category']) }}" data-tags="{{ Str::lower(implode(' ', $post['tags'])) }}">
    <div class="flex flex-wrap items-center gap-3 text-sm text-zinc-500 dark:text-zinc-400">
        <time datetime="{{ $post['date']->toDateString() }}">{{ $post['date']->format('Y-m-d') }}</time>
        <span>{{ $post['category'] }}</span>
        <span>{{ $post['reading_time'] }} min de lectura</span>
        @if ($post['status_label'])<span class="tag-selected">{{ $post['status_label'] }}</span>@endif
    </div>
    <h2 class="mt-3 font-mono text-2xl font-semibold"><a class="hover:text-brand" href="{{ route('blog.show', $post['slug']) }}">{{ $post['title'] }}</a></h2>
    <p class="mt-3 text-zinc-600 dark:text-zinc-300">{{ $post['summary'] }}</p>
    <div class="mt-4 flex flex-wrap gap-2">
        @foreach ($post['tags'] as $tag)
            <button type="button" class="tag" data-tag-filter="{{ $tag }}">{{ $tag }}</button>
        @endforeach
    </div>
</article>
