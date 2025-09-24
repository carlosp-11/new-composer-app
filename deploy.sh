#!/bin/bash

# Script de deployment para Render.com
echo "🚀 Iniciando deployment de Laravel en Render.com..."

# Verificar versión de PHP
echo "📋 Versión PHP: $(php -v | head -n 1)"

# Crear base de datos SQLite si no existe
if [ ! -f /var/www/html/database/production.sqlite ]; then
    echo "📁 Creando base de datos SQLite..."
    touch /var/www/html/database/production.sqlite
fi

# Configurar permisos
echo "🔐 Configurando permisos..."
chmod 664 /var/www/html/database/production.sqlite
chown www-data:www-data /var/www/html/database/production.sqlite
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Verificar que APP_KEY esté configurada
if [ -z "$APP_KEY" ]; then
    echo "❌ ERROR: APP_KEY no está configurada en variables de entorno"
    exit 1
else
    echo "✅ APP_KEY configurada correctamente"
fi

# Limpiar configuraciones antes de migraciones
echo "🧹 Limpiando configuraciones..."
php artisan config:clear
php artisan cache:clear

# Verificar configuración de sesiones
echo "🔧 Configuración de sesiones: $SESSION_DRIVER"

# Ejecutar migraciones (incluye tabla sessions)
echo "📊 Ejecutando migraciones..."
php artisan migrate --force

# Ejecutar seeders (simplificado para debugging)
echo "🌱 Ejecutando seeders..."
php artisan db:seed --force || echo "⚠️ Seeders fallaron, continuando..."

# Optimizar para producción
echo "⚡ Optimizando aplicación..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment completado!"
