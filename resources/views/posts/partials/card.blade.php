<article class="blog-entry fade-in" data-post-card data-title="{{ Str::lower($post['title']) }}" data-summary="{{ Str::lower($post['summary']) }}" data-category="{{ Str::lower($post['category']) }}" data-tags="{{ Str::lower(implode(' ', $post['tags'])) }}">
    <div class="blog-entry-date">
        <time datetime="{{ $post['date']->toDateString() }}">{{ Str::upper($post['date']->locale('es')->translatedFormat('j M, Y')) }}</time>
    </div>
    <div class="blog-entry-body">
        <div class="flex flex-wrap items-center gap-3 text-sm text-zinc-500 dark:text-zinc-400">
            <span>{{ $post['category'] }}</span>
            <span>{{ $post['reading_time'] }} min de lectura</span>
            @if ($post['status_label'])<span class="tag-selected">{{ $post['status_label'] }}</span>@endif
        </div>
        <h2 class="mt-3 text-xl font-semibold text-zinc-950 dark:text-white">
            <a class="hover:text-brand" href="{{ route('blog.show', $post['slug']) }}">{{ $post['title'] }}</a>
        </h2>
        <p class="mt-4 max-w-3xl leading-7 text-zinc-600 dark:text-zinc-300">{{ $post['summary'] }}</p>
        <a href="{{ route('blog.show', $post['slug']) }}" class="mt-5 inline-flex text-sm font-semibold text-brand hover:text-cyan-700">Leer más</a>
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach ($post['tags'] as $tag)
                <button type="button" class="tag tag-subtle" data-tag-filter="{{ $tag }}">{{ $tag }}</button>
            @endforeach
        </div>
    </div>
</article>
