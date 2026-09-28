<?php

namespace App\Console\Commands;

use App\Services\ContentCache;
use Illuminate\Console\Command;

final class ClearContentCacheCommand extends Command
{
    protected $signature = 'karedit:clear-content-cache';

    protected $description = 'Limpia la cache de contenido Markdown y projects.json.';

    public function handle(ContentCache $cache): int
    {
        $cache->clear();
        $this->info('Cache de contenido limpiada.');

        return self::SUCCESS;
    }
}
