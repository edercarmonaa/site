<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

final class VersionCommand extends Command
{
    protected $signature = 'karedit:version';

    protected $description = 'Muestra la version actual de KaredIt.';

    public function handle(): int
    {
        $this->line(trim(file_get_contents(base_path('VERSION')) ?: '0.0.0'));

        return self::SUCCESS;
    }
}
