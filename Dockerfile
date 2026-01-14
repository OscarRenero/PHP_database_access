FROM php:8.2-apache

# Instalamos extensiones necesarias para MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copiamos el código al contenedor
COPY . /var/www/html/

# Ajustamos permisos para que Apache pueda leer los archivos en modo rootless
RUN chmod -R 755 /var/www/html/

EXPOSE 80
