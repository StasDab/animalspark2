@extends('layouts.app')

@section('title', 'Редактировать ' . $cage->name . ' - Виртуальный зоопарк')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">
                    <i class="bi bi-pencil"></i> Редактировать клетку "{{ $cage->name }}"
                </h4>
            </div>
            <div class="card-body">
                @if($cage->animal_count > 0)
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i>
                        <strong>Внимание!</strong> В клетке проживает {{ $cage->animal_count }} животных. 
                        Новый размер клетки не может быть меньше количества проживающих животных.
                    </div>
                @endif
                
                <form action="{{ route('cages.update', $cage) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="bi bi-house"></i> Название клетки <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $cage->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="capacity" class="form-label">
                            <i class="bi bi-people"></i> Вместимость (количество животных) <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                               id="capacity" name="capacity" value="{{ old('capacity', $cage->capacity) }}" 
                               min="{{ $cage->animal_count }}" required>
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Минимальная вместимость: {{ $cage->animal_count }} животных 
                            (количество проживающих животных)
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="bi bi-card-text"></i> Описание клетки
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $cage->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Дополнительная информация о клетке (необязательно)</div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('cages.show', $cage) }}" class="btn btn-secondary me-md-2">
                            <i class="bi bi-arrow-left"></i> Отмена
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle"></i> Обновить клетку
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
