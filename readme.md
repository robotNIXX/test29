# TEST29

## Установка Docker

1. Установить Docker Desktop

## Установка окружения

1. Склонировать репозиторий
2. Создать файл .env по шаблону .env.example
3. Создать файл .env в директории src/api по шаблону .env.example
4. Выполнить команду `docker compose up -d`
5. Выполнить команду `docker compose exec php composer install`
6. Выполнить команду `docker compose exec php php artisan key:generate`
7. Выполнить команду `docker compose exec php php artisan migrate`
8. Выполнить команду `docker compose exec php php artisan db:seed`

## API Documentation

### POST /api/login

Авторизует пользователя

```json
{
    "email": "test@test.com",
    "password": "password"
}
```
__Данные по пользователям можно посмотреть в файле database/seeders/UserSeeder.php__
### GET /api/cars

Возвращает список всех автомобилей

### GET /api/cars/{id}

Возвращает информацию об автомобиле

### POST /api/cars

Создает новый автомобиль

### PUT /api/cars/{id}

Обновляет информацию об автомобиле

### DELETE /api/cars/{id}

Удаляет автомобиль

### GET /api/brands

Возвращает список всех брендов

### GET /api/models

Возвращает список всех моделей