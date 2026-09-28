@php
    $title = $seo['title'] ?? 'Inicio | KaredIt';
    $description = $seo['description'] ?? config('site.description');
    $canonical = $seo['canonical'] ?? config('site.url');
    $robots = $seo['robots'] ?? null;
    $image = rtrim(config('site.url'), '/').config('site.og_image');
@endphp
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ implode(', ', config('site.keywords')) }}">
@if ($robots)<meta name="robots" content="{{ $robots }}">@endif
<link rel="canonical" href="{{ $canonical }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="KaredIt">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $image }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
<meta name="theme-color" content="#00a2c2">
