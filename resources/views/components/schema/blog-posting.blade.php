@props(['post'])
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $post['title'],
    'description' => $post['summary'],
    'datePublished' => $post['date']->toDateString(),
    'author' => ['@type' => 'Person', 'name' => config('site.author')],
    'mainEntityOfPage' => route('blog.show', $post['slug']),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
