@extends('layouts.app')

@section('title', 'Редактировать ' . $animal->name . ' - Виртуальный зоопарк')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">
                    <i class="bi bi-pencil"></i> Редактировать животное "{{ $animal->name }}"
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('animals.update', $animal) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="species" class="form-label">
                            <i class="bi bi-tag"></i> Вид животного <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('species') is-invalid @enderror" 
                               id="species" name="species" value="{{ old('species', $animal->species) }}" required>
                        @error('species')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="bi bi-paw"></i> Имя животного <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $animal->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="age" class="form-label">
                            <i class="bi bi-calendar"></i> Возраст (лет) <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control @error('age') is-invalid @enderror" 
                               id="age" name="age" value="{{ old('age', $animal->age) }}" min="0" required>
                        @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="cage_id" class="form-label">
                            <i class="bi bi-house"></i> Клетка <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('cage_id') is-invalid @enderror" 
                                id="cage_id" name="cage_id" required>
                            <option value="">Выберите клетку</option>
                            @foreach($cages as $cage)
                                <option value="{{ $cage->id }}" 
                                        {{ old('cage_id', $animal->cage_id) == $cage->id ? 'selected' : '' }}>
                                    {{ $cage->name }} 
                                    (свободно: {{ $cage->id == $animal->cage_id ? $cage->free_space + 1 : $cage->free_space }} из {{ $cage->capacity }})
                                </option>
                            @endforeach
                        </select>
                        @error('cage_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="bi bi-card-text"></i> Описание животного
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $animal->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">
                            <i class="bi bi-image"></i> Фотография животного
                        </label>
                        
                        @if($animal->image)
                            <div class="mb-2">
                                <p><strong>Текущая фотография:</strong></p>
                                <img src="{{ $animal->image_url }}" class="img-thumbnail" 
                                     alt="{{ $animal->name }}" style="max-height: 150px;">
                            </div>
                        @endif
                        
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Загрузите новую фотографию животного (JPG, PNG, GIF, до 2MB). 
                            Если не выберете файл, текущая фотография останется.
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('animals.show', $animal) }}" class="btn btn-secondary me-md-2">
                            <i class="bi bi-arrow-left"></i> Отмена
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle"></i> Обновить животное
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
