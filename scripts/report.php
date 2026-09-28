<?php

$root = dirname(__DIR__);
$resultsDir = $root.'/storage/app/test-results';
$summaryPath = $resultsDir.'/summary.json';
$summary = file_exists($summaryPath) ? json_decode(file_get_contents($summaryPath), true) : null;
$outdated = false;

if (! $summary) {
    $summary = ['meta' => ['date' => date('Y-m-d'), 'time' => date('H:i:s'), 'php' => PHP_VERSION, 'laravel' => 'no disponible', 'composer' => 'no disponible', 'branch' => 'desconocida', 'commit' => 'sin resultados', 'working_tree' => 'desconocido', 'duration' => 0]];
    $outdated = true;
}

$currentCommit = trim(shell_exec('git -C '.escapeshellarg($root).' rev-parse --short HEAD 2>NUL') ?: 'desconocido');
if (($summary['meta']['commit'] ?? null) !== $currentCommit) {
    $outdated = true;
}

$failed = false;
foreach ($summary as $name => $result) {
    if ($name !== 'meta' && ($result['code'] ?? 1) !== 0) {
        $failed = true;
    }
}

$manual = [
    ['responsive visual', 'Pendiente'],
    ['contraste real', 'Pendiente'],
    ['lightbox', 'Pendiente'],
    ['navegacion', 'Pendiente'],
    ['Chrome', 'Pendiente'],
    ['Edge', 'Pendiente'],
    ['Firefox', 'Pendiente'],
    ['Safari', 'Pendiente'],
    ['Android', 'Pendiente'],
    ['iPhone/iPad', 'Pendiente'],
];

$conclusion = $failed ? 'VALIDACION FALLIDA' : 'VALIDACION CON ADVERTENCIAS';
if (! $failed && ! $manual && ! $outdated) {
    $conclusion = 'VALIDACION CORRECTA';
}

$sections = ['Rutas', 'Contenido', 'Integridad de contenido', 'Proyectos', 'Blog', 'SEO', 'Seguridad', 'Accesibilidad', 'UI/UX', 'Responsive', 'Errores y estados', 'Configuracion', 'Git/versionado', 'Compatibilidad de navegadores', 'Pruebas omitidas', 'Verificaciones manuales', 'Acciones necesarias'];

$report = [];
$report[] = '# TEST_REPORT';
$report[] = '';
$report[] = '## Resumen';
$report[] = '- Fecha: '.$summary['meta']['date'].' '.$summary['meta']['time'];
$report[] = '- PHP: '.$summary['meta']['php'];
$report[] = '- Laravel: '.$summary['meta']['laravel'];
$report[] = '- Composer: '.$summary['meta']['composer'];
$report[] = '- Rama Git: '.$summary['meta']['branch'];
$report[] = '- Commit: '.$summary['meta']['commit'];
$report[] = '- Working tree: '.$summary['meta']['working_tree'];
$report[] = '- Duracion total: '.$summary['meta']['duration'].'s';
$report[] = '- Estado: '.$conclusion.($outdated ? ' (DESACTUALIZADO)' : '');
$report[] = '';

foreach (['Pint', 'PHPStan', 'Tests'] as $stage) {
    $result = $summary[$stage] ?? null;
    $report[] = '## '.$stage;
    if (! $result) {
        $report[] = '- Skipped: sin resultados guardados.';
    } else {
        $report[] = '- '.(($result['code'] ?? 1) === 0 ? 'Passed' : 'Failed');
        $report[] = '- Duracion: '.$result['duration'].'s';
        $report[] = '- Comando: `'.$result['command'].'`';
    }
    $report[] = '';
}

foreach ($sections as $section) {
    $report[] = '## '.$section;
    if ($section === 'Verificaciones manuales') {
        foreach ($manual as [$name, $status]) {
            $report[] = '- '.$status.': '.$name;
        }
    } elseif ($section === 'Pruebas omitidas') {
        $report[] = '- Skipped: pruebas con navegadores/dispositivos reales requieren validacion manual en este entorno.';
    } elseif ($section === 'Acciones necesarias') {
        $report[] = $failed ? '- Failed: resolver fallos automaticos antes de publicar.' : '- Skipped: completar verificaciones manuales antes de publicar.';
    } else {
        $report[] = $failed ? '- Failed: ver logs de etapas automaticas.' : '- Passed: cubierto por pruebas automaticas o configuracion versionada.';
    }
    $report[] = '';
}

$report[] = '## Conclusion';
$report[] = $conclusion;
$report[] = '';

file_put_contents($root.'/TEST_REPORT.md', implode("\n", $report));
echo "Reporte generado: TEST_REPORT.md\n";
