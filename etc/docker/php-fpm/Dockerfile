FROM php:8.1-fpm

RUN apt update && \
    apt install -y curl  \
    git unzip libxml2-dev  \
    libpq-dev libzip-dev libonig-dev  \
    libgmp-dev libpng-dev libfreetype6-dev \
    libjpeg62-turbo-dev libpng-dev libcurl4-openssl-dev procps \
    && rm -rf /var/lib/apt/lists/*

COPY --chown=www-data:www-data ./ /www

RUN docker-php-ext-install zip  && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install opcache && \
    docker-php-ext-install intl && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install mbstring && \
    docker-php-ext-install pcntl && \
    docker-php-ext-install curl && \
    docker-php-ext-install sockets && \
    docker-php-ext-configure gd \
                    --prefix=/usr \
                    --with-jpeg \
                    --with-webp \
                    --with-xpm \
                    --with-freetype; \
            docker-php-ext-install gd

RUN pecl install redis && \
    docker-php-ext-enable redis && \
    docker-php-ext-enable opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


EXPOSE 9000
