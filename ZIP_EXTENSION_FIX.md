# 🔧 Исправление проблемы с расширением ZIP в XAMPP

## Проблема
Composer не может установить зависимости из-за отсутствия расширения ZIP в PHP.

## Решение

### Шаг 1: Откройте файл php.ini

1. **Откройте XAMPP Control Panel**
2. **Нажмите кнопку "Config" рядом с Apache**
3. **Выберите "PHP (php.ini)"**

Или откройте файл напрямую:
```
C:\xampp\php\php.ini
```

### Шаг 2: Включите расширение ZIP

Найдите в файле php.ini строку:
```ini
;extension=zip
```

И уберите точку с запятой в начале:
```ini
extension=zip
```

### Шаг 3: Включите другие необходимые расширения

Убедитесь, что также включены следующие расширения (уберите `;` в начале строки):

```ini
extension=curl
extension=fileinfo
extension=mbstring
extension=openssl
extension=pdo_mysql
extension=zip
extension=gd
extension=intl
extension=mysqli
extension=xml
extension=xmlreader
extension=xmlwriter
extension=simplexml
extension=dom
extension=json
extension=tokenizer
extension=ctype
extension=bcmath
extension=openssl
```

### Шаг 4: Сохраните файл и перезапустите Apache

1. **Сохраните файл php.ini**
2. **В XAMPP Control Panel остановите Apache (Stop)**
3. **Запустите Apache снова (Start)**

### Шаг 5: Проверьте расширения

Откройте PowerShell и выполните:
```powershell
php -m
```

Должны увидеть в списке:
- zip
- curl
- mbstring
- openssl
- pdo_mysql
- и другие

### Шаг 6: Повторите установку Composer

После включения расширений выполните:
```powershell
php C:\xampp\php\composer install
```

## Альтернативное решение

Если проблема с zip продолжается, можно попробовать установить зависимости с флагом `--prefer-source`:

```powershell
php C:\xampp\php\composer install --prefer-source
```

## Проверка установки

После успешной установки выполните:
```powershell
php C:\xampp\php\composer --version
```

Должно показать версию Composer без ошибок.
