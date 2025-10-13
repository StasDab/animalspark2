@extends('layouts.app')

@section('title', 'Главная - Виртуальный зоопарк')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="bi bi-house-heart"></i> Добро пожаловать в Виртуальный зоопарк!</h1>
        </div>
    </div>
</div>

<!-- Статистика -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="bi bi-grid fs-1"></i>
                <h3>{{ $cages->count() }}</h3>
                <p class="mb-0">Клеток в зоопарке</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="bi bi-heart fs-1"></i>
                <h3>{{ $totalAnimals }}</h3>
                <p class="mb-0">Животных в зоопарке</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="bi bi-people fs-1"></i>
                <h3>{{ $cages->sum('capacity') }}</h3>
                <p class="mb-0">Общая вместимость</p>
            </div>
        </div>
    </div>
</div>

<!-- Клетки -->
<div class="row">
    <div class="col-12">
        <h2><i class="bi bi-grid"></i> Клетки зоопарка</h2>
        <p class="text-muted">Нажмите на клетку, чтобы посмотреть животных</p>
    </div>
</div>

@if($cages->count() > 0)
    <div class="row">
        @foreach($cages as $cage)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card cage-card h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-house"></i> {{ $cage->name }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <strong>Вместимость:</strong> {{ $cage->capacity }} животных<br>
                            <strong>Проживает:</strong> {{ $cage->animal_count }} животных<br>
                            <strong>Свободно:</strong> {{ $cage->free_space }} мест
                        </p>
                        
                        @if($cage->description)
                            <p class="card-text">
                                <small class="text-muted">{{ $cage->description }}</small>
                            </p>
                        @endif
                        
                        <!-- Прогресс-бар заполненности -->
                        <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ $cage->capacity > 0 ? ($cage->animal_count / $cage->capacity) * 100 : 0 }}%">
                            </div>
                        </div>
                        
                        <!-- Список животных -->
                        @if($cage->animals->count() > 0)
                            <h6><i class="bi bi-heart"></i> Животные:</h6>
                            <ul class="list-unstyled">
                                @foreach($cage->animals as $animal)
                                    <li>
                                        <a href="{{ route('animals.show', $animal) }}" class="text-decoration-none">
                                            <i class="bi bi-paw"></i> {{ $animal->name }} ({{ $animal->species }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted"><i class="bi bi-info-circle"></i> В клетке пока нет животных</p>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('cages.show', $cage) }}" class="btn btn-outline-primary">
                                <i class="bi bi-eye"></i> Подробнее
                            </a>
                            @auth
                                <a href="{{ route('cages.edit', $cage) }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-pencil"></i> Редактировать
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle fs-1"></i>
                <h4>В зоопарке пока нет клеток</h4>
                <p>Создайте первую клетку для животных!</p>
                @auth
                    <a href="{{ route('cages.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Создать клетку
                    </a>
                @else
                    <p class="text-muted">Для создания клеток необходимо войти в систему</p>
                @endauth
            </div>
        </div>
    </div>
@endif
@endsection
