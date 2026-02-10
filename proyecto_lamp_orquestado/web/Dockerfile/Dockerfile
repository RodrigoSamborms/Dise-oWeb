FROM php:8.2-fpm-alpine

# Instalar extensiones (aunque sea front, index.php usa curl y mysqli si fuera necesario)
RUN docker-php-ext-install mysqli

# Copiar el código del frontend al contenedor
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html