FROM ggmartinez/laravel:php-82

COPY . /app
WORKDIR /app
RUN mkdir /var/www/database/
RUN composer install
CMD php artisan key:generate && php artisan migrate --force --no-interaction && php artisan serve --host=0.0.0.0
