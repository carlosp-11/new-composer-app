<?php
// Debug script para Render.com - accesible en /debug-render.php

echo "<h1>🔍 Debug Laravel en Render.com</h1>";

echo "<h2>1. PHP Info</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Server: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

echo "<h2>2. Variables de Entorno</h2>";
$env_vars = [
    'APP_NAME', 'APP_ENV', 'APP_KEY', 'APP_DEBUG', 'APP_URL',
    'DB_CONNECTION', 'DB_DATABASE'
];

foreach ($env_vars as $var) {
    $value = getenv($var) ?: 'NO DEFINIDA';
    if ($var === 'APP_KEY' && $value !== 'NO DEFINIDA') {
        $value = substr($value, 0, 20) . '...'; // Ocultar clave completa
    }
    echo "$var: <strong>$value</strong><br>";
}

echo "<h2>3. Estructura de Archivos</h2>";
echo "Laravel Root: " . (file_exists('artisan') ? '✅ Encontrado' : '❌ No encontrado') . "<br>";
echo "Bootstrap: " . (is_dir('bootstrap') ? '✅ Existe' : '❌ No existe') . "<br>";
echo "Storage: " . (is_dir('storage') ? '✅ Existe' : '❌ No existe') . "<br>";
echo "Vendor: " . (is_dir('vendor') ? '✅ Existe' : '❌ No existe') . "<br>";

echo "<h2>4. Permisos</h2>";
if (is_dir('storage')) {
    echo "Storage writable: " . (is_writable('storage') ? '✅ SI' : '❌ NO') . "<br>";
    if (is_dir('storage/logs')) {
        echo "Storage/logs writable: " . (is_writable('storage/logs') ? '✅ SI' : '❌ NO') . "<br>";
    }
}
if (is_dir('bootstrap/cache')) {
    echo "Bootstrap/cache writable: " . (is_writable('bootstrap/cache') ? '✅ SI' : '❌ NO') . "<br>";
}

echo "<h2>5. Database</h2>";
$db_path = getenv('DB_DATABASE') ?: '/var/www/html/database/production.sqlite';
echo "DB Path: $db_path<br>";
echo "DB Exists: " . (file_exists($db_path) ? '✅ SI' : '❌ NO') . "<br>";
if (file_exists($db_path)) {
    echo "DB Size: " . filesize($db_path) . " bytes<br>";
    echo "DB Writable: " . (is_writable($db_path) ? '✅ SI' : '❌ NO') . "<br>";
}

echo "<h2>6. Laravel Boot Test</h2>";
try {
    // Intentar cargar Laravel básico
    require_once 'vendor/autoload.php';
    echo "Autoload: ✅ OK<br>";
    
    $app = require_once 'bootstrap/app.php';
    echo "Bootstrap: ✅ OK<br>";
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "Kernel: ✅ OK<br>";
    
} catch (Exception $e) {
    echo "❌ Laravel Boot Error: " . $e->getMessage() . "<br>";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "<br>";
}

echo "<h2>7. Últimos Logs</h2>";
$log_path = 'storage/logs/laravel.log';
if (file_exists($log_path)) {
    $logs = file_get_contents($log_path);
    $last_lines = array_slice(explode("\n", $logs), -10);
    echo "<pre>" . implode("\n", $last_lines) . "</pre>";
} else {
    echo "❌ No se encontró archivo de logs<br>";
}

echo "<hr><p><small>Debug script - Eliminar después del diagnóstico</small></p>";
?>
