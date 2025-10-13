@extends('layouts.app')

@section('title', 'Виртуальный Зоопарк - Главная')

@section('content')
<div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="jumbotron bg-primary text-white p-5 rounded mb-5">
                    <h1 class="display-4">
                        <i class="bi bi-heart-fill me-3"></i>Добро пожаловать в Виртуальный Зоопарк!
                    </h1>
                    <p class="lead">Управляйте клетками и животными в вашем виртуальном зоопарке</p>
                    <hr class="my-4">
                    <p>Создавайте клетки, добавляйте животных и следите за статистикой вашего зоопарка.</p>
                    <div class="mt-4">
                        <a class="btn btn-light btn-lg me-3" href="{{ route('cages.index') }}" role="button">
                            <i class="bi bi-grid me-2"></i>Просмотр клеток
                        </a>
                        <a class="btn btn-outline-light btn-lg" href="{{ route('animals.index') }}" role="button">
                            <i class="bi bi-heart me-2"></i>Просмотр животных
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-grid-3x3-gap-fill fa-3x text-primary mb-3" style="font-size: 3rem;"></i>
                        <h5 class="card-title">Клетки</h5>
                        <p class="card-text">Создавайте и управляйте клетками для ваших животных</p>
                        <a href="{{ route('cages.index') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-right me-1"></i>Просмотр клеток
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-heart-fill fa-3x text-success mb-3" style="font-size: 3rem;"></i>
                        <h5 class="card-title">Животные</h5>
                        <p class="card-text">Добавляйте и управляйте животными в вашем зоопарке</p>
                        <a href="{{ route('animals.index') }}" class="btn btn-success">
                            <i class="bi bi-arrow-right me-1"></i>Просмотр животных
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
