# 🚀 Инструкция по установке PHP и Composer для Windows

## Шаг 1: Установка PHP

### 1.1 Скачивание PHP

1. **Откройте браузер и перейдите по ссылке:**
   ```
   https://windows.php.net/download/
   ```

2. **Выберите версию:**
   - Рекомендуется: **PHP 8.2** или **PHP 8.3**
   - Выберите **"Thread Safe"** версию
   - Архитектура: **x64** (для 64-битных систем)
   - Формат: **ZIP**

3. **Пример ссылки для скачивания:**
   ```
   https://windows.php.net/downloads/releases/php-8.2.12-Win32-vs16-x64.zip
   ```

### 1.2 Установка PHP

1. **Создайте папку для PHP:**
   ```
   C:\php
   ```

2. **Распакуйте скачанный архив** в папку `C:\php`

3. **Скопируйте конфигурационный файл:**
   - Найдите файл `php.ini-development` в папке `C:\php`
   - Переименуйте его в `php.ini`

4. **Настройте php.ini:**
   - Откройте файл `C:\php\php.ini` в текстовом редакторе
   - Найдите и раскомментируйте (уберите `;`) следующие строки:
   ```ini
   extension=curl
   extension=fileinfo
   extension=mbstring
   extension=openssl
   extension=pdo_mysql
   extension=zip
   extension=gd
   extension=intl
   ```

### 1.3 Добавление PHP в PATH

1. **Откройте системные переменные среды:**
   - Нажмите `Win + R`
   - Введите `sysdm.cpl` и нажмите Enter
   - Перейдите на вкладку **"Дополнительно"**
   - Нажмите **"Переменные среды"**

2. **Добавьте PHP в PATH:**
   - В разделе **"Системные переменные"** найдите переменную `Path`
   - Нажмите **"Изменить"**
   - Нажмите **"Создать"** и добавьте: `C:\php`
   - Нажмите **"ОК"** во всех открытых окнах

3. **Перезапустите PowerShell** для применения изменений

### 1.4 Проверка установки PHP

Откройте новый PowerShell и выполните:
```powershell
php --version
```

Должно появиться что-то вроде:
```
PHP 8.2.12 (cli) (built: Oct 24 2023 16:29:03) ( ZTS Visual C++ 2019 x64 )
```

## Шаг 2: Установка Composer

### 2.1 Скачивание установщика Composer

1. **Откройте PowerShell от имени администратора**

2. **Скачайте установщик Composer:**
   ```powershell
   Invoke-WebRequest -Uri "https://getcomposer.org/installer" -OutFile "composer-setup.php"
   ```

3. **Проверьте хеш установщика:**
   ```powershell
   $hash = (Get-FileHash composer-setup.php -Algorithm SHA384).Hash
   $expectedHash = "dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6d713b86d8a4a481e0d191748ed9a14c"
   if ($hash -eq $expectedHash) { Write-Host "Хеш совпадает!" } else { Write-Host "Хеш НЕ совпадает!" }
   ```

4. **Установите Composer:**
   ```powershell
   php composer-setup.php --install-dir=C:\php --filename=composer
   ```

5. **Удалите установщик:**
   ```powershell
   Remove-Item composer-setup.php
   ```

### 2.2 Проверка установки Composer

Выполните в PowerShell:
```powershell
composer --version
```

Должно появиться что-то вроде:
```
Composer version 2.6.5 2023-10-06 10:11:52
```

## Шаг 3: Установка MySQL (если не установлен)

### 3.1 Скачивание MySQL

1. **Перейдите на сайт MySQL:**
   ```
   https://dev.mysql.com/downloads/mysql/
   ```

2. **Выберите версию:**
   - Рекомендуется: **MySQL 8.0**
   - Выберите **"Windows (x86, 64-bit), ZIP Archive"**

3. **Скачайте архив** и распакуйте в `C:\mysql`

### 3.2 Настройка MySQL

1. **Создайте файл конфигурации:**
   - Создайте файл `C:\mysql\my.ini` со следующим содержимым:
   ```ini
   [mysqld]
   port=3306
   datadir=C:/mysql/data
   max_connections=200
   character-set-server=utf8mb4
   collation-server=utf8mb4_unicode_ci
   
   [mysql]
   default-character-set=utf8mb4
   ```

2. **Инициализируйте MySQL:**
   ```powershell
   C:\mysql\bin\mysqld --initialize --console
   ```

3. **Запустите MySQL:**
   ```powershell
   C:\mysql\bin\mysqld --console
   ```

4. **Установите пароль root (в новом окне PowerShell):**
   ```powershell
   C:\mysql\bin\mysql -u root -p
   ```
   - Введите временный пароль из предыдущего шага
   - Выполните команды:
   ```sql
   ALTER USER 'root'@'localhost' IDENTIFIED BY 'ваш_новый_пароль';
   FLUSH PRIVILEGES;
   EXIT;
   ```

## Шаг 4: Установка зависимостей проекта

После установки PHP и Composer:

1. **Перейдите в папку проекта:**
   ```powershell
   cd "C:\Users\karaz\OneDrive\Desktop\задание1"
   ```

2. **Установите зависимости:**
   ```powershell
   composer install
   ```

3. **Создайте файл .env:**
   ```powershell
   copy .env.example .env
   ```

4. **Сгенерируйте ключ приложения:**
   ```powershell
   php artisan key:generate
   ```

5. **Настройте базу данных в .env:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=virtual_zoo
   DB_USERNAME=root
   DB_PASSWORD=ваш_пароль_от_mysql
   ```

6. **Создайте базу данных:**
   ```powershell
   C:\mysql\bin\mysql -u root -p -e "CREATE DATABASE virtual_zoo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
   ```

7. **Запустите миграции:**
   ```powershell
   php artisan migrate
   ```

8. **Заполните тестовыми данными:**
   ```powershell
   php artisan db:seed
   ```

9. **Создайте символическую ссылку для файлов:**
   ```powershell
   php artisan storage:link
   ```

10. **Запустите приложение:**
    ```powershell
    php artisan serve
    ```

## 🎉 Готово!

Приложение будет доступно по адресу: http://localhost:8000

## 🔧 Альтернативный способ: XAMPP

Если ручная установка кажется сложной, можете использовать XAMPP:

1. **Скачайте XAMPP:**
   ```
   https://www.apachefriends.org/download.html
   ```

2. **Установите XAMPP** (включает PHP, MySQL, Apache)

3. **Добавьте в PATH:**
   - `C:\xampp\php`
   - `C:\xampp\mysql\bin`

4. **Установите Composer** (как описано выше)

5. **Запустите XAMPP Control Panel** и активируйте Apache и MySQL

## ❓ Возможные проблемы

### PHP не найден в командной строке
- Убедитесь, что добавили `C:\php` в PATH
- Перезапустите PowerShell
- Проверьте правильность пути к PHP

### Composer не найден
- Убедитесь, что установили Composer в `C:\php`
- Проверьте, что файл `composer.bat` существует в `C:\php`

### Ошибки подключения к MySQL
- Убедитесь, что MySQL запущен
- Проверьте правильность пароля в .env
- Убедитесь, что база данных создана

### Ошибки расширений PHP
- Проверьте, что раскомментировали нужные расширения в php.ini
- Убедитесь, что файлы расширений существуют в папке `C:\php\ext`

Удачи с установкой! 🚀
