<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

final class ContentCache
{
    public function rememberFile(string $path, callable $callback): mixed
    {
        $mtime = file_exists($path) ? (string) filemtime($path) : 'missing';
        $key = 'content:'.sha1($path.':'.$mtime);

        return Cache::rememberForever($key, $callback);
    }

    public function clear(): void
    {
        Cache::flush();
    }
}
