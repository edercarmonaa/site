@php($variant = $variant ?? 'list')

@if ($variant === 'home')
    <article class="card fade-in" data-post-card data-title="{{ Str::lower($post['title']) }}" data-summary="{{ Str::lower($post['summary']) }}" data-category="{{ Str::lower($post['category']) }}" data-tags="{{ Str::lower(implode(' ', $post['tags'])) }}">
        <div class="flex flex-wrap items-center gap-3 text-sm text-zinc-500 dark:text-zinc-400">
            <time datetime="{{ $post['date']->toDateString() }}">{{ $post['date']->format('Y-m-d') }}</time>
            <span>{{ $post['category'] }}</span>
            <span>{{ $post['reading_time'] }} min de lectura</span>
            @if ($post['status_label'])<span class="tag-selected">{{ $post['status_label'] }}</span>@endif
        </div>
        <h2 class="mt-3 font-mono text-2xl font-semibold">
            <a class="hover:text-brand" href="{{ route('blog.show', $post['slug']) }}">{{ $post['title'] }}</a>
        </h2>
        <p class="mt-3 text-zinc-600 dark:text-zinc-300">{{ $post['summary'] }}</p>
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach ($post['tags'] as $tag)
                <button type="button" class="tag" data-tag-filter="{{ $tag }}">{{ $tag }}</button>
            @endforeach
        </div>
    </article>
@else
    <article class="grid min-h-36 border-b border-zinc-200 transition-colors hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-800/45 md:grid-cols-[18rem_minmax(0,1fr)]" data-post-card data-title="{{ Str::lower($post['title']) }}" data-summary="{{ Str::lower($post['summary']) }}" data-category="{{ Str::lower($post['category']) }}" data-tags="{{ Str::lower(implode(' ', $post['tags'])) }}">
        <div class="px-4 py-6 font-mono text-xs uppercase tracking-widest text-zinc-600 dark:text-zinc-400 md:px-6 md:py-8">
            <time datetime="{{ $post['date']->toDateString() }}">{{ Str::upper($post['date']->locale('es')->translatedFormat('j M, Y')) }}</time>
        </div>
        <div class="border-zinc-200 px-4 pb-6 dark:border-zinc-700 md:border-l md:px-8 md:py-8">
            <h2 class="text-base font-semibold text-zinc-950 dark:text-white">
                <a class="hover:text-brand" href="{{ route('blog.show', $post['slug']) }}">{{ $post['title'] }}</a>
            </h2>
            <p class="mt-4 max-w-3xl text-sm leading-7 text-zinc-600 dark:text-zinc-300">{{ $post['summary'] }}</p>
            <div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-2">
                <a href="{{ route('blog.show', $post['slug']) }}" class="inline-flex text-sm font-semibold text-brand hover:text-cyan-700">Leer más</a>
                <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ $post['category'] }} · {{ $post['reading_time'] }} min de lectura</span>
                @if ($post['status_label'])<span class="tag-selected">{{ $post['status_label'] }}</span>@endif
            </div>
        </div>
    </article>
@endif
