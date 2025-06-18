# Dockerfile para proyecto Laravel

FROM php:7.4-fpm

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
WORKDIR /var/www/Rinconcitofinal-app

# Copiar solo la carpeta Rinconcitofinal-app al contenedor
COPY Rinconcitofinal-app ./ 

# Instalar dependencias PHP con Composer
RUN composer install --no-dev --optimize-autoloader

# Establecer permisos para almacenamiento y cache
RUN chown -R www-data:www-data /var/www/Rinconcitofinal-app/storage /var/www/Rinconcitofinal-app/bootstrap/cache

# Exponer puerto 9000 para php-fpm
EXPOSE 9000

# Comando para iniciar php-fpm
CMD ["php-fpm"]
