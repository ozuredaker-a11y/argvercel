FROM php:8.1-apache

# Install common extensions that many PHP apps need
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libonig-dev \
        libzip-dev \
        zip \
        unzip \
        git \
    && docker-php-ext-install pdo pdo_mysql mbstring zip \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy app files
COPY . /var/www/html/

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

EXPOSE 80

CMD ["apache2-foreground"]
