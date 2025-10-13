@extends('layouts.app')

@section('title', 'Создать клетку - Виртуальный зоопарк')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="bi bi-plus-circle"></i> Создать новую клетку
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('cages.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="bi bi-house"></i> Название клетки <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="capacity" class="form-label">
                            <i class="bi bi-people"></i> Вместимость (количество животных) <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                               id="capacity" name="capacity" value="{{ old('capacity') }}" 
                               min="1" required>
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Укажите максимальное количество животных, которое может разместиться в клетке</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="bi bi-card-text"></i> Описание клетки
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Дополнительная информация о клетке (необязательно)</div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('home') }}" class="btn btn-secondary me-md-2">
                            <i class="bi bi-arrow-left"></i> Отмена
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Создать клетку
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
