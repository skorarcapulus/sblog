FROM wordpress:6.6.2-php8.3-fpm

# Tools, Extensions, WP-CLI, Xdebug
RUN set -ex \
 && apt-get update \
 && apt-get install -y --no-install-recommends \
    less mariadb-client vim unzip git libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd zip \
 && pecl install xdebug \
 && docker-php-ext-enable xdebug \
 && curl -o /usr/local/bin/wp -L https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
 && chmod +x /usr/local/bin/wp \
 && rm -rf /var/lib/apt/lists/*

# PHP Tweaks
COPY php.ini $PHP_INI_DIR/conf.d/99-custom.ini

# UID/GID angleichen (für Host-Write-Rechte)
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data