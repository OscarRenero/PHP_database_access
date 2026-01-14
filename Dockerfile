FROM php:8.2-apache

# Instalamos extensiones para PDO
RUN docker-php-ext-install pdo pdo_mysql

# Copiamos el código
COPY . /var/www/html/

# IMPORTANTE: En Podman rootless, a veces es mejor dejar que 
# el usuario por defecto gestione los archivos o usar:
RUN chmod -R 755 /var/www/html/

EXPOSE 80
