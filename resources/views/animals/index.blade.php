@extends('layouts.app')

@section('title', 'Животные - Виртуальный зоопарк')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="bi bi-heart"></i> Животные зоопарка</h1>
            @auth
                <a href="{{ route('animals.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Добавить животное
                </a>
            @endauth
        </div>
    </div>
</div>

@if($animals->count() > 0)
    <div class="row">
        @foreach($animals as $animal)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card animal-card h-100">
                    @if($animal->image)
                        <img src="{{ $animal->image_url }}" class="card-img-top" 
                             alt="{{ $animal->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="bi bi-image fs-1 text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-paw"></i> {{ $animal->name }}
                        </h5>
                        <p class="card-text">
                            <strong>Вид:</strong> {{ $animal->species }}<br>
                            <strong>Возраст:</strong> {{ $animal->age }} лет<br>
                            <strong>Клетка:</strong> 
                            <a href="{{ route('cages.show', $animal->cage) }}" class="text-decoration-none">
                                {{ $animal->cage->name }}
                            </a>
                        </p>
                        
                        @if($animal->description)
                            <p class="card-text">
                                <small class="text-muted">{{ Str::limit($animal->description, 100) }}</small>
                            </p>
                        @endif
                    </div>
                    
                    <div class="card-footer">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('animals.show', $animal) }}" class="btn btn-outline-primary">
                                <i class="bi bi-eye"></i> Подробнее
                            </a>
                            @auth
                                <a href="{{ route('animals.edit', $animal) }}" class="btn btn-outline-secondary">
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
                <i class="bi bi-heart fs-1"></i>
                <h4>В зоопарке пока нет животных</h4>
                <p>Добавьте первое животное в зоопарк!</p>
                @auth
                    <a href="{{ route('animals.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Добавить животное
                    </a>
                @else
                    <p class="text-muted">Для добавления животных необходимо войти в систему</p>
                @endauth
            </div>
        </div>
    </div>
@endif
@endsection
