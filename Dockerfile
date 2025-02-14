# Usamos la imagen base de PHP con FPM
FROM php:8.2-fpm

# Actualizamos e instalamos dependencias del sistema y Nginx
RUN apt-get update && apt-get install -y \
    nginx \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libxpm-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    bash \
    fcgiwrap \
    libmcrypt-dev \
    libonig-dev \
    libpq-dev \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# Instalamos extensiones de PHP necesarias para Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath opcache intl

# Instalamos Composer de manera optimizada
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

COPY .. /var/www/html/

# Copiamos la configuración de Nginx
COPY deploy/nginx.conf /etc/nginx/conf.d/default.conf

# Establecemos los permisos correctos para la aplicación
RUN chown -R www-data:www-data /var/www/html/

RUN chown -R www-data:www-data /var/lib/nginx

# Instalamos las dependencias de Laravel en modo producción
RUN composer install --no-dev --optimize-autoloader

# Exponemos el puerto 80 (Nginx) y el 9000 (PHP-FPM)
EXPOSE 80 9000

# Comando para iniciar Nginx y PHP-FPM juntos
CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]
