FROM php:8.2-apache

# Installation de l'extension mysqli pour PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copie des fichiers du projet dans le serveur web Apache
COPY . /var/www/html/

# Exposer le port 80
EXPOSE 80