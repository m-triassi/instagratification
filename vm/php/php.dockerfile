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
    && docker-php-ext-install -j$(nproc) gd
    #&& pecl install redis \
    #&& docker-php-ext-enable redis \
    #&& pecl install xdebug \
    #&& docker-php-ext-enable xdebug

# Configure PHP
COPY ./vm/php/php.ini ${PHP_INI_DIR}/