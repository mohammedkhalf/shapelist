FROM nginx:1-alpine AS web-server
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf
COPY ./public /var/www/app/public
EXPOSE 80

FROM php:7.2-fpm-stretch AS php-application

ENV LARAVEL_VERSION 6.0
ENV INSTALL_DIR /var/www/app
ENV COMPOSER_HOME /var/www/.composer/

# Install common tools and libraries
RUN apt-get update && apt-get install -y \
  cron \
  git \
  gzip \
  libfreetype6-dev \
  libicu-dev \
  libjpeg62-turbo-dev \
  libmcrypt-dev \
  libpng-dev \
  libxslt1-dev \
  libmagickwand-dev \
  lsof \
  mysql-client \
  vim \
  zip \
  unzip \
  curl \
  openssl \
  libssl-dev \
  libcurl4-openssl-dev

RUN pecl install imagick-3.4.3

# http://devdocs.magento.com/guides/v2.0/install-gde/system-requirements.html
RUN docker-php-ext-install bcmath \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-install gd \
  && docker-php-ext-install intl \
  && docker-php-ext-install mbstring \
  && docker-php-ext-install opcache \
  && docker-php-ext-install pdo_mysql \
  && docker-php-ext-install zip \
  && docker-php-ext-install xml \
  && docker-php-ext-install ctype \
  && docker-php-ext-install json \
  && docker-php-ext-enable imagick \
  && docker-php-ext-install bz2 \
  && docker-php-ext-install exif

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Make sure the volume mount point is empty
# RUN rm -rf /var/www/app/*

# Set www-data as owner for /var/www
# RUN chown -R www-data:www-data /var/www/
# RUN chmod -R g+w /var/www/

# Remove unnecssary modules
# RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install app dependencies
WORKDIR /var/www/app
COPY composer.* /var/www/app/
COPY database /var/www/app/database
COPY tests /var/www/app/tests
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --optimize-autoloader --no-scripts

# PHP setup
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# copy project files
COPY . /var/www/app
RUN chown -R www-data:www-data \
        /var/www/app/storage \
        /var/www/app/bootstrap/cache \
        && touch /var/www/app/storage/logs/laravel.log \
        && chmod 666 /var/www/app/storage/logs/laravel.log

# COPY docker/app/vhost.conf /etc/apache2/sites-available/000-default.conf
