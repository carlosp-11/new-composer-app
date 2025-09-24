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

# Generar clave de aplicación si no existe
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generando clave de aplicación..."
    php artisan key:generate --force
fi

# Ejecutar migraciones
echo "📊 Ejecutando migraciones..."
php artisan migrate --force

# Ejecutar seeders solo si la base de datos está vacía
USER_COUNT=$(php artisan tinker --execute="echo App\Models\User::count();")
if [ "$USER_COUNT" -eq "0" ]; then
    echo "🌱 Ejecutando seeders..."
    php artisan db:seed --force
fi

# Limpiar y cachear configuraciones
echo "⚡ Optimizando aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment completado!"
