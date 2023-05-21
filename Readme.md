# PHP Docker Image

https://hub.docker.com/_/php


Other links:

https://stackoverflow.com/questions/1678010/php-server-on-local-machine

https://betterprogramming.pub/live-reloading-with-docker-compose-for-efficient-development-356d50e91e39

https://docs.docker.com/compose/gettingstarted/


https://www.digitalocean.com/community/tutorials/how-to-remove-docker-images-containers-and-volumes

https://www.freecodecamp.org/news/how-to-remove-all-docker-images-a-docker-cleanup-guide/


# Install PHP on Ubuntu 22.04
https://www.digitalocean.com/community/tutorials/how-to-install-php-8-1-and-set-up-a-local-development-environment-on-ubuntu-22-04

## Apache Mod Rewrite on Ubuntu 22.04
https://www.digitalocean.com/community/tutorials/how-to-rewrite-urls-with-mod_rewrite-for-apache-on-ubuntu-22-04


## Check Ubuntu Version

https://linuxize.com/post/how-to-check-your-ubuntu-version/
    
    cat /etc/issue


## Docker Compose

https://docs.docker.com/compose/gettingstarted/


### Commands

    docker compose up --build -d


## PHP Server

https://codingshower.com/serve-local-directory-with-php-web-server/


## PHP Deployments

https://flaviocopes.com/php-deployment/

https://www.cloudbees.com/blog/setting-up-and-deploying-a-modern-php-application

https://www.codementor.io/php/tutorial/how-to-setup-php-development-production-server


## PHP References

https://php.earth/

https://stitcher.io/blog/new-in-php-81

https://phprouter.com/


## Refresh CSS

https://stackoverflow.com/questions/11474345/force-browser-to-refresh-css-javascript-etc


## Hosting / Deployment

https://app.infinityfree.net/accounts/epiz_34213687


# Project 

https://devprojects.lovestoblog.com/


## HTACCESS

    DirectoryIndex index.php

https://stackoverflow.com/questions/18406156/redirect-all-to-index-php-using-htaccess

    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ /index.php?path=$1 [NC,L,QSA]


https://help.dreamhost.com/hc/en-us/articles/215747758-Force-your-site-to-load-securely-with-an-htaccess-file

    RewriteEngine On
    RewriteCond %{HTTPS} !=on
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301,NE]
    Header always set Content-Security-Policy "upgrade-insecure-requests;"
    <IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteRule ^index\.php$ - [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /index.php [L]
    </IfModule>

https://www.geeksforgeeks.org/what-is-htaccess-file-in-php/


## Docker PHP Dockerfile

    FROM php:8.1-cli
    WORKDIR /usr/public/
    COPY ./src .
    CMD ["php", "-S", "0.0.0.0:8000", "-t", "src/"]

## Check if apache is running on Linux

    ps -ef | grep -i "httpd\|apache"


## Docker Environment

https://docs.docker.com/compose/compose-file/05-services/#environment


## MySQL

https://hub.docker.com/_/mysql


### MySQL docker-compose

https://blog.devgenius.io/how-i-setup-mysql-in-docker-compose-e05ba7bcfece


### MySQL connection error

https://stackoverflow.com/questions/29395452/php-connection-failed-sqlstatehy000-2002-connection-refused
--> working answer: https://stackoverflow.com/a/72699622

### MySQL 8.0 Manual

https://dev.mysql.com/doc/refman/8.0/en/creating-database.html