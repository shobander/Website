# Update the VARIANT arg in docker-compose.yml to pick a PHP version: 7, 7.4, 7.3
ARG VARIANT=7.3
# FROM mcr.microsoft.com/vscode/devcontainers/php:dev-${VARIANT}

FROM php:${VARIANT}-fpm

# Install MariaDB client
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -y mariadb-client

# Install Laravel Requirements
    # gd
RUN apt-get install -y \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev libwebp-dev  \
    libzip-dev \
    zip \
    libonig-dev \
    libxml2-dev \
    libbz2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
RUN php -m
    # gmp
RUN apt-get install -y --no-install-recommends libgmp-dev \
    && docker-php-ext-install gmp \
    # pdo_mysql
    && docker-php-ext-install pdo_mysql \
    # opcache
    && docker-php-ext-enable opcache \
    # zip
    && docker-php-ext-install zip \
    && docker-php-ext-install bcmath 

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Prepare for Node LTS install
COPY ./misc/nodejs/nodesource.list  /etc/apt/sources.list.d/nodesource.list
COPY ./misc/nodejs/nodesource.gpg   /etc/apt/trusted.gpg.d/nodesource.gpg

# Install Node
RUN apt-get install -y nodejs npm 

# Clean up
RUN apt-get autoclean -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/pear/

# Update args in docker-compose.yaml to set the UID/GID of the "vscode" user.
ARG USER_UID=1000
ARG USER_GID=$USER_UID
RUN if [ "$USER_GID" != "1000" ] || [ "$USER_UID" != "1000" ]; then \
        groupmod --gid $USER_GID vscode \
        && usermod --uid $USER_UID --gid $USER_GID vscode \
        && chmod -R $USER_UID:$USER_GID /home/vscode \
        && chmod -R $USER_UID:root /usr/local/share/nvm; \
    fi

