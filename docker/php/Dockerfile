FROM php:8.4.17-fpm-trixie

RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    zip  \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN echo "date.timezone=Europe/Moscow" > /usr/local/etc/php/conf.d/timezone.ini

WORKDIR /var/www/short_link

CMD ["php-fpm", "-R"]