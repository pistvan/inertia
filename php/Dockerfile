FROM php:8.3-fpm-alpine

# Install Composer.
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

# Install dependencies
RUN apk add --update --no-cache \
        linux-headers \
        npm \
        $PHPIZE_DEPS && \
# Install & enable Xdebug
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
# Install extensions
    docker-php-ext-install \
        pdo_mysql

ENV HOME=/var/www

# Set up PHP
RUN ln -s $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini \
# Create Composer directory.
    && mkdir -p /var/www/.composer \
    && chmod -R 777 /var/www/.composer \
# Create npm directory.
    && mkdir -p /var/www/.npm \
    && chmod -R 777 /var/www/.npm \
# Create directory for Artisan tinker.
    && mkdir -p /var/www/.config/psysh \
    && chmod -R 777 /var/www/.config

WORKDIR "/var/www/html"

USER www-data
