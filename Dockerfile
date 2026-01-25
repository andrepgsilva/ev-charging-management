FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libzip-dev \
    libonig-dev \
    zip \
    git \
    unzip \
    libpq-dev \
    procps \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql zip bcmath opcache sockets \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-autoloader --no-scripts --no-progress --prefer-dist

COPY ./docker/xdebug.ini /usr/local/etc/php/conf.d/

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN rm -f /etc/nginx/sites-enabled/default

CMD sh -c "php-fpm & exec nginx -g 'daemon off;'"
