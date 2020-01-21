#
# PHP Dependencies
#
FROM composer:1.8 as vendor

COPY database/ database/
COPY nova-components/ nova-components/
COPY packages/ packages/
COPY composer.json composer.lock auth.json ./

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

#
# Frontend
#
FROM node:8 as frontend

RUN mkdir -p app/public

COPY package.json webpack.mix.js yarn.lock app/
COPY nova-components/ app/nova-components/
COPY resources/ app/resources/

WORKDIR app/

RUN yarn install && yarn production && yarn yarn-key-management-field && yarn build-key-management-field-prod

#
# Application
#
FROM php:7.2-fpm

RUN apt-get update -yqq && apt-get install -yqq --no-install-recommends \
    # Install Build tools
    apt-utils \
    build-essential \
    nano \
    xvfb \
    unzip \
    wget \
    # Install libs for building PHP exts
    libicu-dev \
    libpq-dev \
    libmcrypt-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libbz2-dev \
    # Install tools
    mysql-client \
    # Clean up apt
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
# Install PHP extensions
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-install \
        bcmath \
        bz2 \
        # curl \
        intl \
        # iconv \
        # json \
        # mbstring \
        opcache \
        pcntl \
        # pdo \
        pdo_mysql \
        # pdo_pgsql \
        # pdo_sqlite \
        # pgsql \
        # tokenizer \
        # xml \
        zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    #&& pecl install redis && docker-php-ext-enable redis \
    #&& pecl install xdebug && docker-php-ext-enable xdebug \
    # Clean up final
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Configure PHP
COPY ./vm/php/php.ini ${PHP_INI_DIR}/
# Copy Laravel Application
COPY . /var/www
COPY --from=vendor /app/vendor/ /var/www/vendor/
COPY --from=frontend /app/public/ /var/www/public/
COPY --from=frontend /app/mix-manifest.json /var/www/mix-manifest.json

