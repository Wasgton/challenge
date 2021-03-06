FROM php:7.2-apache
RUN apt-get update
RUN apt-get install -y \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++ \
    nano \
    cron

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite headers

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install  \
    mysqli  \
    pdo \
    pdo_mysql\
    bz2 \
    intl \
    iconv \
    bcmath \
    opcache \
    calendar \
    mbstring \
    pdo_mysql \
    zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG uid
RUN useradd -G www-data,root -u $uid -d /home/admin admin
RUN mkdir -p /home/admin/.composer && \
    chown -R admin:admin /home/admin

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN service apache2 restart
