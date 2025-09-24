# Usa la imagen oficial de PHP 8.2 con Apache (requerido por Symfony 7.x)
FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    sqlite3 \
    libsqlite3-dev

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar Apache
RUN a2enmod rewrite
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de la aplicación
COPY . .

# Crear directorio para SQLite y establecer permisos
RUN mkdir -p /var/www/html/database && \
    mkdir -p /var/www/html/storage/logs && \
    mkdir -p /var/www/html/storage/framework/cache && \
    mkdir -p /var/www/html/storage/framework/sessions && \
    mkdir -p /var/www/html/storage/framework/views && \
    mkdir -p /var/www/html/bootstrap/cache && \
    touch /var/www/html/database/production.sqlite && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/storage && \
    chmod -R 775 /var/www/html/bootstrap/cache && \
    chmod 664 /var/www/html/database/production.sqlite

# Limpiar y reinstalar dependencias PHP con versión correcta
RUN rm -f composer.lock && \
    composer install --optimize-autoloader --no-dev

# Instalar dependencias Node.js y compilar assets
RUN npm install && npm run build

# Configurar Laravel (sin cache para debugging)
# RUN php artisan config:cache && \
#     php artisan route:cache && \
#     php artisan view:cache

# Exponer puerto 80
EXPOSE 80

# Copiar script de inicialización
COPY startup.sh /usr/local/bin/startup.sh
RUN chmod +x /usr/local/bin/startup.sh

# Comando de inicio - ejecuta migraciones y luego Apache
CMD ["/usr/local/bin/startup.sh"]
