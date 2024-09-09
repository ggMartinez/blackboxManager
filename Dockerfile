FROM ggmartinez/laravel:php-82

COPY . /app
WORKDIR /app
RUN mkdir /var/www/database/
RUN composer install && php artisan key:generate
CMD php artisan migrate --force --no-interaction && php artisan serve --host=0.0.0.0
