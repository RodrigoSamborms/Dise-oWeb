FROM php:8.2-fpm-alpine

# Instalar extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli

# Copiar el código de la API al contenedor
COPY . /var/www/html/

# Establecer permisos (opcional pero recomendado)
RUN chown -R www-data:www-data /var/www/html