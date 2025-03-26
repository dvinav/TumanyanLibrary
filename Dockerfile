FROM php:5.6-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy custom Apache configuration
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf
