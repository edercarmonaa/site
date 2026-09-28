<?php

$root = dirname(__DIR__);
$resultsDir = $root.'/storage/app/test-results';
deleteDirectory($resultsDir);
mkdir($resultsDir, 0777, true);

$stages = [
    'Pint' => './vendor/bin/pint --test',
    'PHPStan' => './vendor/bin/phpstan analyse --no-progress',
    'Tests' => './vendor/bin/phpunit',
];

$summary = [];
$overallStart = microtime(true);

foreach ($stages as $name => $command) {
    $start = microtime(true);
    [$code, $output] = run($command, $root);
    file_put_contents($resultsDir.'/'.strtolower($name).'.log', $output);
    $summary[$name] = [
        'command' => $command,
        'code' => $code,
        'duration' => round(microtime(true) - $start, 2),
    ];
    echo ($code === 0 ? "✓ {$name}\n" : "✕ {$name}\n");
}

$summary['meta'] = metadata($root, round(microtime(true) - $overallStart, 2));
file_put_contents($resultsDir.'/summary.json', json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

$reportStart = microtime(true);
passthru(PHP_BINARY.' '.$root.'/scripts/report.php', $reportCode);
$summary['Reporte generado'] = [
    'command' => 'composer report',
    'code' => $reportCode,
    'duration' => round(microtime(true) - $reportStart, 2),
];
file_put_contents($resultsDir.'/summary.json', json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo ($reportCode === 0 ? "✓ Reporte generado\n" : "⚠ Reporte generado\n");

exit(collectFailures($summary) || $reportCode !== 0 ? 1 : 0);

function run(string $command, string $cwd): array
{
    $descriptor = [1 => ['pipe', 'w'], 2 => ['pipe', 'w']];
    $process = proc_open($command, $descriptor, $pipes, $cwd);
    if (! is_resource($process)) {
        return [1, 'No se pudo ejecutar '.$command];
    }
    $output = stream_get_contents($pipes[1]).stream_get_contents($pipes[2]);
    foreach ($pipes as $pipe) {
        fclose($pipe);
    }

    return [proc_close($process), $output];
}

function metadata(string $root, float $duration): array
{
    return [
        'date' => date('Y-m-d'),
        'time' => date('H:i:s'),
        'php' => PHP_VERSION,
        'laravel' => class_exists(\Illuminate\Foundation\Application::class) ? \Illuminate\Foundation\Application::VERSION : 'no disponible',
        'composer' => trim(shell_exec('composer --version 2>NUL') ?: 'no disponible'),
        'branch' => trim(shell_exec('git -C '.escapeshellarg($root).' branch --show-current 2>NUL') ?: 'desconocida'),
        'commit' => trim(shell_exec('git -C '.escapeshellarg($root).' rev-parse --short HEAD 2>NUL') ?: 'desconocido'),
        'working_tree' => trim(shell_exec('git -C '.escapeshellarg($root).' status --short 2>NUL') ?: '') === '' ? 'limpio' : 'sucio',
        'duration' => $duration,
    ];
}

function collectFailures(array $summary): bool
{
    foreach ($summary as $name => $result) {
        if ($name !== 'meta' && ($result['code'] ?? 1) !== 0) {
            return true;
        }
    }

    return false;
}

function deleteDirectory(string $path): void
{
    if (! is_dir($path)) {
        return;
    }
    $items = array_diff(scandir($path), ['.', '..']);
    foreach ($items as $item) {
        $target = $path.'/'.$item;
        is_dir($target) ? deleteDirectory($target) : unlink($target);
    }
    rmdir($path);
}
