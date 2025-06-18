# Dockerfile para proyecto Laravel con PHP 8.1

FROM php:8.1-fpm

# Instalar dependencias del sistema y extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias PHP con Composer
RUN composer install --no-dev --optimize-autoloader

# Establecer permisos para almacenamiento y cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exponer puerto 9000 para php-fpm
EXPOSE 9000

# Comando para iniciar php-fpm
CMD ["php-fpm"]
