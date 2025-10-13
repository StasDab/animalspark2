@extends('layouts.app')

@section('title', $animal->name . ' - Виртуальный зоопарк')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="bi bi-paw"></i> {{ $animal->name }}
            </h1>
            <div class="btn-group">
                @auth
                    <a href="{{ route('animals.edit', $animal) }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil"></i> Редактировать
                    </a>
                @endauth
                <a href="{{ route('animals.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Назад
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Фотография животного -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="bi bi-image"></i> Фотография
                </h5>
            </div>
            <div class="card-body text-center">
                @if($animal->image)
                    <img src="{{ $animal->image_url }}" class="img-fluid rounded" 
                         alt="{{ $animal->name }}" style="max-height: 300px;">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                         style="height: 300px;">
                        <div>
                            <i class="bi bi-image fs-1 text-muted"></i>
                            <p class="text-muted mt-2">Фотография не загружена</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Информация о животном -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle"></i> Информация о животном
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong><i class="bi bi-paw"></i> Имя:</strong> {{ $animal->name }}</p>
                        <p><strong><i class="bi bi-tag"></i> Вид:</strong> {{ $animal->species }}</p>
                        <p><strong><i class="bi bi-calendar"></i> Возраст:</strong> {{ $animal->age }} лет</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong><i class="bi bi-house"></i> Клетка:</strong> 
                            <a href="{{ route('cages.show', $animal->cage) }}" class="text-decoration-none">
                                {{ $animal->cage->name }}
                            </a>
                        </p>
                        <p><strong><i class="bi bi-clock"></i> Добавлено:</strong> 
                            {{ $animal->created_at->format('d.m.Y H:i') }}
                        </p>
                        @if($animal->updated_at != $animal->created_at)
                            <p><strong><i class="bi bi-pencil"></i> Обновлено:</strong> 
                                {{ $animal->updated_at->format('d.m.Y H:i') }}
                            </p>
                        @endif
                    </div>
                </div>
                
                @if($animal->description)
                    <hr>
                    <h6><i class="bi bi-card-text"></i> Описание:</h6>
                    <p>{{ $animal->description }}</p>
                @endif
            </div>
        </div>
        
        <!-- Информация о клетке -->
        <div class="card mt-3">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="bi bi-house"></i> Информация о клетке
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Название:</strong> 
                            <a href="{{ route('cages.show', $animal->cage) }}" class="text-decoration-none">
                                {{ $animal->cage->name }}
                            </a>
                        </p>
                        <p><strong>Вместимость:</strong> {{ $animal->cage->capacity }} животных</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Проживает:</strong> {{ $animal->cage->animal_count }} животных</p>
                        <p><strong>Свободно:</strong> {{ $animal->cage->free_space }} мест</p>
                    </div>
                </div>
                
                @if($animal->cage->description)
                    <hr>
                    <p><strong>Описание клетки:</strong></p>
                    <p>{{ $animal->cage->description }}</p>
                @endif
                
                <!-- Прогресс-бар заполненности клетки -->
                <hr>
                <p><strong>Заполненность клетки:</strong></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" 
                         style="width: {{ $animal->cage->capacity > 0 ? ($animal->cage->animal_count / $animal->cage->capacity) * 100 : 0 }}%">
                        {{ $animal->cage->capacity > 0 ? round(($animal->cage->animal_count / $animal->cage->capacity) * 100) : 0 }}%
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Действия -->
        <div class="card mt-3">
            <div class="card-body">
                <h6><i class="bi bi-gear"></i> Действия</h6>
                <div class="d-grid gap-2 d-md-flex">
                    <a href="{{ route('cages.show', $animal->cage) }}" class="btn btn-outline-success me-md-2">
                        <i class="bi bi-house"></i> Посмотреть клетку
                    </a>
                    @auth
                        <a href="{{ route('animals.edit', $animal) }}" class="btn btn-outline-primary me-md-2">
                            <i class="bi bi-pencil"></i> Редактировать животное
                        </a>
                        <form action="{{ route('animals.destroy', $animal) }}" method="POST" 
                              onsubmit="return confirm('Вы уверены, что хотите удалить это животное?')" 
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash"></i> Удалить животное
                            </button>
                        </form>
                    @else
                        <p class="text-muted text-center flex-grow-1">
                            <i class="bi bi-info-circle"></i> 
                            Для управления животными необходимо войти в систему
                        </p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
