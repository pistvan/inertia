FROM php:8.3-fpm-alpine

# Install Composer.
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

# Install dependencies
RUN apk add --update --no-cache \
        linux-headers \
        $PHPIZE_DEPS && \
# Install & enable Xdebug
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
# Install extensions
    docker-php-ext-install \
        pdo_mysql

# Set up PHP
RUN ln -s $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini \
# Install Composer
    && mkdir -p /.composer \
    && chmod -R 777 /.composer \
# Create directory for Artisan tinker.
    && mkdir -p /.config/psysh \
    && chmod -R 777 /.config

WORKDIR "/var/www"

USER www-data
