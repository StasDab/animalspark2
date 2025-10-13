@extends('layouts.app')

@section('title', $cage->name . ' - Виртуальный зоопарк')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="bi bi-house"></i> {{ $cage->name }}
            </h1>
            <div class="btn-group">
                @auth
                    <a href="{{ route('cages.edit', $cage) }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil"></i> Редактировать
                    </a>
                @endauth
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Назад
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Информация о клетке -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle"></i> Информация о клетке
                </h5>
            </div>
            <div class="card-body">
                <p><strong>Название:</strong> {{ $cage->name }}</p>
                <p><strong>Вместимость:</strong> {{ $cage->capacity }} животных</p>
                <p><strong>Проживает:</strong> {{ $cage->animal_count }} животных</p>
                <p><strong>Свободно:</strong> {{ $cage->free_space }} мест</p>
                
                @if($cage->description)
                    <hr>
                    <p><strong>Описание:</strong></p>
                    <p>{{ $cage->description }}</p>
                @endif
                
                <!-- Прогресс-бар заполненности -->
                <hr>
                <p><strong>Заполненность:</strong></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" 
                         style="width: {{ $cage->capacity > 0 ? ($cage->animal_count / $cage->capacity) * 100 : 0 }}%">
                        {{ $cage->capacity > 0 ? round(($cage->animal_count / $cage->capacity) * 100) : 0 }}%
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Действия -->
        <div class="card mt-3">
            <div class="card-body">
                <h6><i class="bi bi-gear"></i> Действия</h6>
                <div class="d-grid gap-2">
                    @auth
                        <a href="{{ route('animals.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Добавить животное
                        </a>
                        <a href="{{ route('cages.edit', $cage) }}" class="btn btn-outline-primary">
                            <i class="bi bi-pencil"></i> Редактировать клетку
                        </a>
                        @if($cage->animal_count == 0)
                            <form action="{{ route('cages.destroy', $cage) }}" method="POST" 
                                  onsubmit="return confirm('Вы уверены, что хотите удалить эту клетку?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="bi bi-trash"></i> Удалить клетку
                                </button>
                            </form>
                        @else
                            <button class="btn btn-outline-danger" disabled title="Нельзя удалить клетку с животными">
                                <i class="bi bi-trash"></i> Удалить клетку
                            </button>
                        @endif
                    @else
                        <p class="text-muted text-center">
                            <i class="bi bi-info-circle"></i> 
                            Для управления клетками необходимо войти в систему
                        </p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    
    <!-- Животные в клетке -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="bi bi-heart"></i> Животные в клетке ({{ $cage->animal_count }})
                </h5>
            </div>
            <div class="card-body">
                @if($cage->animals->count() > 0)
                    <div class="row">
                        @foreach($cage->animals as $animal)
                            <div class="col-md-6 mb-3">
                                <div class="card animal-card h-100">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="bi bi-paw"></i> {{ $animal->name }}
                                        </h6>
                                        <p class="card-text">
                                            <strong>Вид:</strong> {{ $animal->species }}<br>
                                            <strong>Возраст:</strong> {{ $animal->age }} лет
                                        </p>
                                        @if($animal->description)
                                            <p class="card-text">
                                                <small class="text-muted">{{ Str::limit($animal->description, 100) }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('animals.show', $animal) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i> Подробнее
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-heart fs-1 text-muted"></i>
                        <h5 class="text-muted">В клетке пока нет животных</h5>
                        <p class="text-muted">Добавьте первое животное в эту клетку!</p>
                        <a href="{{ route('animals.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Добавить животное
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
