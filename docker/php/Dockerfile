FROM php:7.3-fpm

RUN apt-get update;

RUN docker-php-ext-install pdo_mysql

# legacy stuff depends to smartadmin instalation

# RUN apt-get install -y \
#         libxml2-dev \
#         libpng-dev \
#         libmcrypt-dev \
#         libreadline-dev;

# RUN docker-php-ext-install dom
# RUN docker-php-ext-install gd
# RUN docker-php-ext-install json
# RUN docker-php-ext-install mbstring

# RUN pecl install mcrypt-1.0.2
# RUN docker-php-ext-enable mcrypt
