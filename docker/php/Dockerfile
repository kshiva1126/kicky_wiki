FROM php:7.3.5-fpm

# Composer environment
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

# tinker(psysh)
ARG PSYSH_DIR=/usr/local/share/psysh
ARG PHP_MANUAL_URL=http://psysh.org/manual/ja/php_manual.sqlite

# timezone
ARG TZ=Asia/Tokyo

# Composer install
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

# Node.js
RUN curl -sL https://deb.nodesource.com/setup_11.x | bash -
RUN apt-get install -y nodejs
RUN npm install npm@latest -g

RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
vim \
vim-gnome \
&& echo ":set encoding=utf-8" >> ~/.vimrc \
&& echo ":set fileencodings=iso-2022-jp,euc-jp,sjis,utf-8" >> ~/.vimrc

RUN apt-get update \
&& apt-get install -y \
locales \
locales-all \
&& locale-gen ja_JP.UTF-8 && update-locale \
&& echo "export LANG=ja_JP.UTF-8" >> ~/.bashrc

# tinker日本語入力設定
RUN apt-get update \
&& apt-get install -y \
gcc \
ncurses-dev

RUN curl https://www.thrysoee.dk/editline/libedit-20190324-3.1.tar.gz -O \
&& tar -zxvf libedit-20190324-3.1.tar.gz \
&& cd libedit-20190324-3.1/ \
&& ./configure && make \
&& cp -i ./src/.libs/libedit.so.0.0.60 /usr/lib/x86_64-linux-gnu/ \
&& cd /usr/lib/x86_64-linux-gnu/ \
&& unlink libedit.so.2 \
&& ln -s libedit.so.0.0.60 libedit.so.2

# PHPのExtensionsを導入
RUN apt-get update \
&& apt-get install -y libpq-dev \
libfreetype6-dev \
libjpeg62-turbo-dev \
libpng-dev \
&& docker-php-ext-install pdo_mysql pdo_pgsql \
&& docker-php-ext-install -j$(nproc) iconv \
&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
&& docker-php-ext-install -j$(nproc) gd

# Config
COPY php.ini /usr/local/etc/php
COPY aliases.sh /etc/profile.d
COPY crontab/laravel /var/spool/cron/crontabs/root
