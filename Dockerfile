FROM php:8.0 as php

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

#RUN chmod +x docker/entrypoint.sh
# Set working directory
WORKDIR /var/www

COPY . .
# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV PORT=8001
ENTRYPOINT [ "docker/entrypoint.sh" ]

# Create system user to run Composer and Artisan Commands
# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user


# USER $user
FROM node:16-alpine as node

WORKDIR /var/www

COPY . .

RUN npm install

VOLUME /var/www/node_modules