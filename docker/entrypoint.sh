#!/bin/bash

if [! -f "vendor/autoload.php"]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev -o
fi

if [! -f ".env"]; then
    echo "Creating env file for $APP_ENV"
    cp .env.example .env
else
    echo "env file already exists"
fi

php artisan migrate
php artisan key:generate
php artisan db:seed

php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
exec docker-php-entrypoint "$@"