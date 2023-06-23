FROM ubuntu/apache2
RUN apt update && apt install --no-install-recommends php8.1 -y
COPY ./000-default.conf /etc/apache2/sites-available/
RUN a2enmod rewrite
RUN service apache2 restart 
RUN apt-get install -y \
php8.1-cli \
php8.1-common \
php8.1-curl \
php8.1-zip \
php8.1-mysql

#add composer and update
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
WORKDIR /var/www/
COPY ./composer.json .
RUN composer update

#https://www.smarty.net/quick_install
RUN mkdir smarty && \
mkdir smarty/cache && \
mkdir smarty/configs && \
mkdir smarty/templates_c
RUN chown www-data:www-data smarty/templates_c
RUN chown www-data:www-data smarty/cache
RUN chmod 775 smarty/templates_c
RUN chmod 775 smarty/cache
