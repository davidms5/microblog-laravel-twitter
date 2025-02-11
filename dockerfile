# Imagen base oficial de PHP con extensiones necesarias
FROM php:8.2-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring

# Instalar OPcache
RUN docker-php-ext-install opcache

# Copiar configuraciones personalizadas
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Instalar la extensión de Redis
RUN pecl install redis && docker-php-ext-enable redis
# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear el directorio de la aplicación
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . .

# Crear directorios necesarios para Laravel y asignar permisos
RUN mkdir -p /var/www/storage/framework/{sessions,views,cache} /var/www/bootstrap/cache && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Instalar dependencias de Laravel
RUN composer install --no-dev


CMD ["php-fpm"]
