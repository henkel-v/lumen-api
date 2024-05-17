# Loan API

## Описание
REST API для управления займами.

## Установка
```sh
git clone https://github.com/yourusername/loan-api.git
cd loan-api
composer install
cp .env.example .env
php artisan migrate
php -S localhost:8000 -t public
