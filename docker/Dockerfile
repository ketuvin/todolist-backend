FROM php:8.1-fpm

# Install dependencies and Composer
RUN apt-get update && \
    apt-get install -y curl git unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer 

# Install PHP PDO MySQL extension
RUN docker-php-ext-install pdo_mysql
