FROM ubuntu/apache2
RUN apt update && apt install --no-install-recommends php8.1 -y
COPY ./000-default.conf /etc/apache2/sites-available/
RUN a2enmod rewrite
RUN service apache2 restart 
RUN apt-get install -y \
php8.1-cli \
php8.1-common \
php8.1-mysql \
php8.1-zip \
php8.1-gd \
php8.1-mbstring \
php8.1-curl \
php8.1-xml \
php8.1-bcmath