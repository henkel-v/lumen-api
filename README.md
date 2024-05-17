# Loan API

## Описание
REST API для управления займами.

## Установка
```sh
git clone https://github.com/yourusername/lumen-api.git
cd lumen-api
composer install
cp .env.example .env
php artisan migrate
php -S localhost:8000 -t public
```

Использование:

- Создание займа: POST /loans
- Получение информации о займе: GET /loans/{id}
- Обновление информации о займе: PUT /loans/{id}
- Удаление займа: DELETE /loans/{id}
- Получение списка всех займов: GET /loans
