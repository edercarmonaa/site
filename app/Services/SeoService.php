<?php

namespace App\Services;

use Illuminate\Http\Request;

final class SeoService
{
    public function canonical(Request $request, ?string $override = null): string
    {
        if ($override) {
            return $override;
        }

        return rtrim(config('site.url'), '/').'/'.ltrim($request->path() === '/' ? '' : $request->path(), '/');
    }

    public function robots(Request $request): ?string
    {
        return $request->query() === [] ? null : 'noindex, follow';
    }
}
