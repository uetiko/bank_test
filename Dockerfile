FROM php:7.3-fpm-alpine

WORKDIR /opt/uetiko/app

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ icu-dev \
    && pecl install xdebug-2.7.0RC2 \
    && docker-php-ext-install -j$(nproc) \
        bcmath

COPY etc/infrastructure/php/ /usr/local/etc/php/

ADD etc/infrastructure/docker/start.sh /initation/start.sh

RUN chmod 755 /initation/start.sh

VOLUME ["/opt/uetiko/app"]

ENTRYPOINT ["/initation/start.sh"]