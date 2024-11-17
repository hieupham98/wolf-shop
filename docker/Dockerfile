FROM php:8.3-fpm AS php8

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        ssh \
        git \
      	supervisor \
        cron \
        nano \
        vim \
        net-tools \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync

RUN install-php-extensions \
  bcmath \
  bz2 \
  gmp \
  calendar \
  exif \
  gd \
  intl \
  ldap \
  mcrypt \
  mysqli \
  opcache \
  pdo_mysql \
  zip \
  pcntl \
  pdo \
  pdo_sqlite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
