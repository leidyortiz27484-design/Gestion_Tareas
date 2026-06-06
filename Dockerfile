# Usamos la imagen oficial de PHP con Apache incluido
FROM php:8.2-apache

# Instalamos la extensión PDO MySQL necesaria para conectar con la base de datos
RUN docker-php-ext-install pdo pdo_mysql

# Habilitamos el módulo de reescritura de Apache (buena práctica para MVC)
RUN a2enmod rewrite

# Copiamos todo el código de nuestra carpeta local al contenedor de Docker
COPY . /var/www/html/

# Aseguramos los permisos correctos para que Apache pueda leer los archivos
RUN chown -R www-data:www-data /var/www/html/
