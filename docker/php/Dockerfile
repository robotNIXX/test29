FROM php:8.3-fpm

# Устанавливаем системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Устанавливаем PHP расширения
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip opcache

# Копируем конфигурацию PHP
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создаем пользователя для приложения
RUN groupadd -g 1000 appuser && \
    useradd -u 1000 -g appuser -m appuser

# Создаем рабочую директорию
WORKDIR /app

# Копируем composer файлы для оптимизации слоев
COPY --chown=appuser:appuser src/api/composer.json src/api/composer.lock ./

# Устанавливаем зависимости PHP (без post-install скриптов)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Копируем исходный код приложения
COPY --chown=appuser:appuser src/api .

# Создаем необходимые директории и устанавливаем права
RUN mkdir -p storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/app/public \
    bootstrap/cache \
    /var/log

# Устанавливаем правильные права доступа
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R appuser:appuser storage bootstrap/cache

# Создаем .env файл если его нет
RUN if [ ! -f .env ] && [ -f .env.example ]; then \
        cp .env.example .env; \
    fi

# Теперь выполняем post-install скрипты Laravel
# RUN composer run-scripts post-autoload-dump

# Выполняем команды Laravel только если artisan файл существует
RUN if [ -f artisan ]; then \
        php artisan key:generate --no-interaction || true && \
        php artisan config:clear && \
        php artisan cache:clear && \
        php artisan view:clear; \
    fi

# Переключаемся на пользователя приложения
USER appuser

# Открываем порт
EXPOSE 9000

# Запускаем php-fpm
CMD ["php-fpm"]
