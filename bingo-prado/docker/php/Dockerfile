# Image and version
# FROM php:8.1-fpm
FROM php:5.5.38-fpm-alpine

# Install dependencies
# RUN apk update 
#* PDO EXIF    The apk is not working!
# RUN apk add php7-exif
RUN docker-php-ext-install exif

#* EXT-GD      The apk is not working!
# RUN apk add php7-gd
# RUN apk add libpng libpng-dev && docker-php-ext-install gd && apk del libpng-dev

#* PDO MYSQL   The apk is not working!
# RUN apk add php7-pdo php7-pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql
# RUN apt update && \
#     apt install --no-install-recommends -y \
#     zlib1g-dev \
#     libpng-dev \
#     libzip-dev \
#     unzip

# Call PHP images script `docker-php-ext-install` and install language extensions
# RUN docker-php-ext-install  \
#     zip

# copy the Composer PHAR from the Composer image into the PHP image
# COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install xdebug
# RUN pecl install xdebug && docker-php-ext-enable xdebug
# COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini