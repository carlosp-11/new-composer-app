#!/bin/bash

echo "🚀 ===== INICIANDO APLICACIÓN C-DEPOT ====="

# Verificar variables de entorno críticas
echo "🔧 Verificando configuración..."
echo "APP_ENV: $APP_ENV"
echo "APP_DEBUG: $APP_DEBUG"
echo "DB_CONNECTION: $DB_CONNECTION"
echo "SESSION_DRIVER: $SESSION_DRIVER"

# Verificar que APP_KEY esté configurada
if [ -z "$APP_KEY" ]; then
    echo "❌ ERROR: APP_KEY no está configurada"
    exit 1
else
    echo "✅ APP_KEY configurada correctamente"
fi

# Verificar y crear base de datos SQLite
echo "📊 Configurando base de datos SQLite..."
DB_PATH="/var/www/html/database/production.sqlite"

if [ ! -f "$DB_PATH" ]; then
    echo "📁 Creando archivo de base de datos..."
    touch "$DB_PATH"
fi

# Configurar permisos
echo "🔐 Configurando permisos..."
chown -R www-data:www-data /var/www/html/database
chown -R www-data:www-data /var/www/html/storage
chmod 664 "$DB_PATH"
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Limpiar configuraciones
echo "🧹 Limpiando configuraciones..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Aplicar migraciones pendientes (no destructivo)
echo "📊 ===== APLICANDO MIGRACIONES PENDIENTES ====="
php artisan migrate --force

# Verificar que las tablas se crearon
echo "🔍 Verificando tablas creadas..."
php -r "
\$pdo = new PDO('sqlite:/var/www/html/database/production.sqlite');
\$stmt = \$pdo->query('SELECT name FROM sqlite_master WHERE type=\"table\"');
\$tables = \$stmt->fetchAll(PDO::FETCH_COLUMN);
echo '📋 Tablas encontradas: ' . count(\$tables) . PHP_EOL;
foreach(\$tables as \$table) {
    echo '  - ' . \$table . PHP_EOL;
}
if (in_array('users', \$tables)) {
    echo '✅ Tabla users: EXISTE' . PHP_EOL;
} else {
    echo '❌ Tabla users: NO EXISTE' . PHP_EOL;
    exit 1;
}
"

# Ejecutar seeders solo si la tabla users está vacía (primer arranque)
echo "🌱 Verificando si se necesitan seeders..."
USERS_COUNT=$(php -r "
\$pdo = new PDO('sqlite:/var/www/html/database/production.sqlite');
\$stmt = \$pdo->query('SELECT COUNT(*) FROM users');
echo \$stmt->fetchColumn();
" 2>/dev/null || echo "0")

if [ "$USERS_COUNT" = "0" ]; then
    echo "🌱 Base de datos vacía. Ejecutando seeders iniciales..."
    php artisan db:seed --force
else
    echo "✅ Base de datos ya inicializada ($USERS_COUNT usuarios). Omitiendo seeders."
fi

# Verificar usuarios demo
echo "👥 Verificando usuarios demo..."
php -r "
\$pdo = new PDO('sqlite:/var/www/html/database/production.sqlite');
\$stmt = \$pdo->query('SELECT COUNT(*) as count FROM users');
\$result = \$stmt->fetch(PDO::FETCH_ASSOC);
echo '👤 Total usuarios: ' . \$result['count'] . PHP_EOL;

\$stmt = \$pdo->query('SELECT email FROM users WHERE email = \"demo@inventario.com\"');
if(\$stmt->fetch()) {
    echo '✅ Usuario demo: EXISTE' . PHP_EOL;
} else {
    echo '❌ Usuario demo: NO EXISTE' . PHP_EOL;
}
"

# Optimizar para producción
echo "⚡ Optimizando aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ ===== CONFIGURACIÓN COMPLETADA ====="
echo "🌐 Iniciando servidor Apache..."

# Iniciar Apache en foreground
exec apache2-foreground
