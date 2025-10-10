# Инструкция по установке и запуску "Виртуальный зоопарк"

## Предварительные требования

Перед установкой убедитесь, что на вашем компьютере установлены:

- **PHP 8.1 или выше** с расширениями:
  - BCMath PHP Extension
  - Ctype PHP Extension
  - cURL PHP Extension
  - DOM PHP Extension
  - Fileinfo PHP Extension
  - JSON PHP Extension
  - Mbstring PHP Extension
  - OpenSSL PHP Extension
  - PCRE PHP Extension
  - PDO PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension

- **Composer** - менеджер зависимостей PHP
- **MySQL 5.7 или выше** (или MariaDB 10.2+)
- **Веб-сервер** (Apache, Nginx) или встроенный сервер PHP

## Установка

### 1. Клонирование проекта

```bash
# Если проект уже создан локально, перейдите в его директорию
cd путь/к/проекту/virtual-zoo

# Или клонируйте из репозитория (если есть)
git clone <repository-url>
cd virtual-zoo
```

### 2. Установка зависимостей

```bash
# Установите зависимости Composer
composer install
```

### 3. Настройка окружения

```bash
# Скопируйте файл конфигурации окружения
cp .env.example .env

# Сгенерируйте ключ приложения
php artisan key:generate
```

### 4. Настройка базы данных

Отредактируйте файл `.env` и укажите параметры подключения к базе данных:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=virtual_zoo
DB_USERNAME=root
DB_PASSWORD=ваш_пароль
```

### 5. Создание базы данных

Создайте базу данных в MySQL:

```sql
CREATE DATABASE virtual_zoo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Запуск миграций

```bash
# Создайте таблицы в базе данных
php artisan migrate
```

### 7. Заполнение тестовыми данными (опционально)

```bash
# Заполните базу данных тестовыми клетками и животными
php artisan db:seed
```

### 8. Настройка хранения файлов

```bash
# Создайте символическую ссылку для доступа к загруженным файлам
php artisan storage:link
```

### 9. Установка прав доступа (для Linux/Mac)

```bash
# Установите права на запись для директорий storage и bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

## Запуск приложения

### Вариант 1: Встроенный сервер PHP (для разработки)

```bash
# Запустите встроенный сервер
php artisan serve
```

Приложение будет доступно по адресу: http://localhost:8000

### Вариант 2: Настройка веб-сервера

#### Apache

1. Создайте виртуальный хост, указывающий на директорию `public/`
2. Убедитесь, что включен mod_rewrite
3. Пример конфигурации:

```apache
<VirtualHost *:80>
    ServerName virtual-zoo.local
    DocumentRoot /path/to/virtual-zoo/public
    
    <Directory /path/to/virtual-zoo/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Nginx

```nginx
server {
    listen 80;
    server_name virtual-zoo.local;
    root /path/to/virtual-zoo/public;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## Проверка установки

После запуска приложения:

1. Откройте браузер и перейдите по адресу приложения
2. Вы должны увидеть главную страницу зоопарка
3. Если запускали сидеры, на странице будут отображаться тестовые клетки и животные

## Возможные проблемы и решения

### Ошибка "Class not found"

```bash
# Очистите кэш и перегенерируйте автозагрузку
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### Ошибка подключения к базе данных

1. Проверьте параметры подключения в `.env`
2. Убедитесь, что MySQL сервер запущен
3. Проверьте, что база данных создана

### Ошибка "Storage link not found"

```bash
# Пересоздайте символическую ссылку
php artisan storage:link
```

### Ошибка прав доступа

```bash
# Установите правильные права (Linux/Mac)
sudo chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

## Структура проекта

```
virtual-zoo/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Контроллеры
│   │   └── Requests/        # Валидация запросов
│   ├── Models/             # Модели Eloquent
│   └── Providers/          # Провайдеры сервисов
├── config/                 # Конфигурационные файлы
├── database/
│   ├── migrations/         # Миграции БД
│   └── seeders/           # Сидеры для тестовых данных
├── public/                 # Публичные файлы (точка входа)
├── resources/
│   └── views/             # Blade шаблоны
├── routes/                # Маршруты
├── storage/               # Файлы приложения
└── composer.json          # Зависимости
```

## Команды Artisan

```bash
# Просмотр всех доступных команд
php artisan list

# Запуск миграций
php artisan migrate

# Откат миграций
php artisan migrate:rollback

# Запуск сидеров
php artisan db:seed

# Очистка кэша
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Создание символической ссылки для storage
php artisan storage:link
```

## Дополнительные настройки

### Настройка для продакшена

1. Установите `APP_ENV=production` в `.env`
2. Установите `APP_DEBUG=false` в `.env`
3. Оптимизируйте приложение:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Настройка почты

Для отправки уведомлений настройте параметры почты в `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

## Поддержка

Если у вас возникли проблемы с установкой или запуском приложения, проверьте:

1. Версии PHP и MySQL
2. Права доступа к файлам и директориям
3. Настройки веб-сервера
4. Логи ошибок в `storage/logs/laravel.log`

Удачной работы с Виртуальным зоопарком! 🦁🐧🐒
