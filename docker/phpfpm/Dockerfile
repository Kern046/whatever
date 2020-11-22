FROM php:fpm-alpine

ARG xdebug=''

COPY docker-entrypoint.sh /entrypoint.sh
COPY crontab /var/spool/cron/crontabs/app-cron
COPY uploads.ini /usr/local/etc/php/conf.d/uploads.ini

RUN chown root:root /entrypoint.sh && chmod a+x /entrypoint.sh \
    && apk add $PHPIZE_DEPS wget zip unzip icu-dev libpng-dev jpeg-dev freetype-dev libjpeg-turbo-dev libwebp-dev zlib-dev libxpm-dev dos2unix \
    && dos2unix /entrypoint.sh \
    && chmod 0644 /var/spool/cron/crontabs/app-cron \
    && touch /var/log/cron.log \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
    && docker-php-ext-install -j${NPROC} pdo pdo_mysql intl opcache gd \
    && pecl install redis $xdebug && docker-php-ext-enable redis $xdebug \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/bin/ --filename=composer \
    && php -r "unlink('composer-setup.php');"

ENTRYPOINT ["/entrypoint.sh"]