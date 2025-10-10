# API Документация - Виртуальный зоопарк

## Обзор

API для веб-приложения "Виртуальный зоопарк" предоставляет RESTful интерфейс для управления клетками и животными.

## Базовый URL

```
http://localhost:8000/api
```

## Аутентификация

В текущей версии API не требует аутентификации. В будущих версиях планируется добавить API токены.

## Формат ответов

Все ответы возвращаются в формате JSON:

### Успешный ответ
```json
{
    "success": true,
    "data": {
        // данные
    },
    "message": "Операция выполнена успешно"
}
```

### Ошибка
```json
{
    "success": false,
    "error": "Описание ошибки",
    "errors": {
        "field": ["Сообщение об ошибке"]
    }
}
```

## Клетки (Cages)

### Получить список всех клеток

**GET** `/cages`

**Ответ:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Большая клетка для хищников",
            "capacity": 5,
            "description": "Просторная клетка для крупных хищных животных",
            "animal_count": 2,
            "free_space": 3,
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        }
    ]
}
```

### Получить конкретную клетку

**GET** `/cages/{id}`

**Параметры:**
- `id` (integer) - ID клетки

**Ответ:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Большая клетка для хищников",
        "capacity": 5,
        "description": "Просторная клетка для крупных хищных животных",
        "animal_count": 2,
        "free_space": 3,
        "animals": [
            {
                "id": 1,
                "species": "Лев",
                "name": "Симба",
                "age": 5,
                "description": "Величественный самец льва",
                "image": "animals/simba.jpg",
                "created_at": "2024-01-01T00:00:00.000000Z",
                "updated_at": "2024-01-01T00:00:00.000000Z"
            }
        ],
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

### Создать новую клетку

**POST** `/cages`

**Тело запроса:**
```json
{
    "name": "Новая клетка",
    "capacity": 10,
    "description": "Описание клетки"
}
```

**Ответ:**
```json
{
    "success": true,
    "data": {
        "id": 2,
        "name": "Новая клетка",
        "capacity": 10,
        "description": "Описание клетки",
        "animal_count": 0,
        "free_space": 10,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    },
    "message": "Клетка успешно создана"
}
```

### Обновить клетку

**PUT** `/cages/{id}`

**Параметры:**
- `id` (integer) - ID клетки

**Тело запроса:**
```json
{
    "name": "Обновленное название",
    "capacity": 8,
    "description": "Обновленное описание"
}
```

### Удалить клетку

**DELETE** `/cages/{id}`

**Параметры:**
- `id` (integer) - ID клетки

**Ответ:**
```json
{
    "success": true,
    "message": "Клетка успешно удалена"
}
```

## Животные (Animals)

### Получить список всех животных

**GET** `/animals`

**Ответ:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "species": "Лев",
            "name": "Симба",
            "age": 5,
            "description": "Величественный самец льва",
            "image": "animals/simba.jpg",
            "cage_id": 1,
            "cage": {
                "id": 1,
                "name": "Большая клетка для хищников",
                "capacity": 5
            },
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        }
    ]
}
```

### Получить конкретное животное

**GET** `/animals/{id}`

**Параметры:**
- `id` (integer) - ID животного

### Создать новое животное

**POST** `/animals`

**Тело запроса:**
```json
{
    "species": "Тигр",
    "name": "Амур",
    "age": 7,
    "description": "Красивый амурский тигр",
    "cage_id": 1,
    "image": "base64_encoded_image_or_file"
}
```

### Обновить животное

**PUT** `/animals/{id}`

**Параметры:**
- `id` (integer) - ID животного

### Удалить животное

**DELETE** `/animals/{id}`

**Параметры:**
- `id` (integer) - ID животного

## Статистика

### Получить статистику зоопарка

**GET** `/statistics`

**Ответ:**
```json
{
    "success": true,
    "data": {
        "total_cages": 6,
        "total_animals": 10,
        "total_capacity": 36,
        "cages_by_capacity": [
            {
                "name": "Большая клетка для хищников",
                "capacity": 5,
                "animal_count": 2,
                "utilization_percent": 40
            }
        ],
        "animals_by_species": [
            {
                "species": "Лев",
                "count": 1
            },
            {
                "species": "Тигр",
                "count": 1
            }
        ]
    }
}
```

## Коды ошибок

| Код | Описание |
|-----|----------|
| 200 | Успешно |
| 201 | Создано |
| 400 | Неверный запрос |
| 404 | Не найдено |
| 422 | Ошибка валидации |
| 500 | Внутренняя ошибка сервера |

## Примеры использования

### JavaScript (Fetch API)

```javascript
// Получить список клеток
fetch('/api/cages')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Клетки:', data.data);
        }
    });

// Создать новое животное
fetch('/api/animals', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        species: 'Слон',
        name: 'Дамбо',
        age: 10,
        description: 'Дружелюбный слон',
        cage_id: 1
    })
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        console.log('Животное создано:', data.data);
    } else {
        console.error('Ошибка:', data.error);
    }
});
```

### PHP (cURL)

```php
// Получить список животных
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/api/animals');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
if ($data['success']) {
    foreach ($data['data'] as $animal) {
        echo $animal['name'] . ' (' . $animal['species'] . ')' . PHP_EOL;
    }
}
```

## Планы развития API

- [ ] Аутентификация через API токены
- [ ] Пагинация для больших списков
- [ ] Фильтрация и сортировка
- [ ] Поиск по животным и клеткам
- [ ] Экспорт данных в различных форматах
- [ ] WebSocket для real-time обновлений
- [ ] Rate limiting для защиты от злоупотреблений
