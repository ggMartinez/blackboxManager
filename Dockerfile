FROM ggmartinez/laravel:php-8.2-apache-arm64

COPY . /var/www/html
WORKDIR /var/www/html
RUN mkdir /var/www/database
RUN composer install --prefer-dist
RUN chown -R apache /var/www/html/storage && chown -R apache /var/www/database
