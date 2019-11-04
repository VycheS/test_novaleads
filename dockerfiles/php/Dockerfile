FROM php:7.2-apache
# ENV HTTP_PROXY "http://127.0.0.1:8080"
# ENV HTTPS_PROXY "https://127.0.0.1:8080"
RUN apt-get update
RUN a2enmod rewrite && service apache2 restart