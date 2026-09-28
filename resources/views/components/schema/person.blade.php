<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    'name' => config('site.author'),
    'jobTitle' => 'Software Developer',
    'url' => config('site.url'),
    'email' => 'mailto:'.config('site.email'),
    'sameAs' => array_values(array_filter([config('site.github'), config('site.linkedin')])),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
