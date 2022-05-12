FROM php:7.4-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo_mysql
RUN apt-get update && apt-get upgrade -y
RUN apt-get install cron curl git unzip -y
RUN a2enmod rewrite
RUN service apache2 restart
RUN cd ~
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html
COPY . ./
COPY crons /etc/cron.d/crons
RUN chmod 0644 /etc/cron.d/crons
RUN crontab /etc/cron.d/crons
RUN composer install