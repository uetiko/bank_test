FROM php:7.3-fpm-alpine

WORKDIR /opt/uetiko/app

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ icu-dev \
    && pecl install xdebug-2.7.0RC2 \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        pdo_mysql \
    && docker-php-ext-enable

COPY etc/infrastructure/php/ /usr/local/etc/php/

RUN zsh -c "$(curl -fsSL https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh)" ||true

RUN ln -f /bin/zsh /bin/sh

VOLUME ["/opt/uetiko/app"]