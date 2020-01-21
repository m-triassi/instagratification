FROM php:7.2-fpm

# Install Apt transport for node/yarn repo's
RUN apt-get update -yqq && apt-get upgrade -yqq \
    && apt-get -yqq install apt-transport-https ca-certificates wget gnupg \
    # Install, start with Yarn and NodeJS repo keys
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
    && curl -sL https://deb.nodesource.com/setup_6.x | bash - \
    && apt-get install -yqq --no-install-recommends \
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
        mariadb-client \
        git \
        nodejs \
        npm \
        yarn \
    # Clean Up apt
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    # Install Composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    # Install PHPUnit
    && wget https://phar.phpunit.de/phpunit.phar \
    && chmod +x phpunit.phar && mv phpunit.phar /usr/local/bin/phpunit \
    # Install Global NPM packages
    && npm install -g gulp

# Copy Config
COPY /vm/php/php.ini ${PHP_INI_DIR}/
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
    && pecl install xdebug && docker-php-ext-enable xdebug \
    # Clean up final
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# YOUR APP SHOULD BE RUNNING. THIS IMAGE DOES NOT CONTAIN A WEB SERVER OR A DB.
