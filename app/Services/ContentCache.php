<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ContentCache
{
    public function rememberFile(string $path, callable $callback): mixed
    {
        $mtime = file_exists($path) ? (string) filemtime($path) : 'missing';
        $key = 'content:'.sha1($path.':'.$mtime);

        try {
            return Cache::rememberForever($key, $callback);
        } catch (Throwable $e) {
            Log::warning('Content cache unavailable; reading source file directly.', [
                'path' => $path,
                'error' => $e->getMessage(),
            ]);

            return $callback();
        }
    }

    public function clear(): void
    {
        Cache::flush();
    }
}
