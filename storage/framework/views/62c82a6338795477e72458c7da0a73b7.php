

<?php $__env->startSection('title', $animal->name . ' - Виртуальный зоопарк'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="bi bi-paw"></i> <?php echo e($animal->name); ?>

            </h1>
            <div class="btn-group">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('animals.edit', $animal)); ?>" class="btn btn-outline-primary">
                        <i class="bi bi-pencil"></i> Редактировать
                    </a>
                <?php endif; ?>
                <a href="<?php echo e(route('animals.index')); ?>" class="btn btn-outline-secondary">
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
                <?php if($animal->image): ?>
                    <img src="<?php echo e($animal->image_url); ?>" class="img-fluid rounded" 
                         alt="<?php echo e($animal->name); ?>" style="max-height: 300px;">
                <?php else: ?>
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                         style="height: 300px;">
                        <div>
                            <i class="bi bi-image fs-1 text-muted"></i>
                            <p class="text-muted mt-2">Фотография не загружена</p>
                        </div>
                    </div>
                <?php endif; ?>
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
                        <p><strong><i class="bi bi-paw"></i> Имя:</strong> <?php echo e($animal->name); ?></p>
                        <p><strong><i class="bi bi-tag"></i> Вид:</strong> <?php echo e($animal->species); ?></p>
                        <p><strong><i class="bi bi-calendar"></i> Возраст:</strong> <?php echo e($animal->age); ?> лет</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong><i class="bi bi-house"></i> Клетка:</strong> 
                            <a href="<?php echo e(route('cages.show', $animal->cage)); ?>" class="text-decoration-none">
                                <?php echo e($animal->cage->name); ?>

                            </a>
                        </p>
                        <p><strong><i class="bi bi-clock"></i> Добавлено:</strong> 
                            <?php echo e($animal->created_at->format('d.m.Y H:i')); ?>

                        </p>
                        <?php if($animal->updated_at != $animal->created_at): ?>
                            <p><strong><i class="bi bi-pencil"></i> Обновлено:</strong> 
                                <?php echo e($animal->updated_at->format('d.m.Y H:i')); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php if($animal->description): ?>
                    <hr>
                    <h6><i class="bi bi-card-text"></i> Описание:</h6>
                    <p><?php echo e($animal->description); ?></p>
                <?php endif; ?>
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
                            <a href="<?php echo e(route('cages.show', $animal->cage)); ?>" class="text-decoration-none">
                                <?php echo e($animal->cage->name); ?>

                            </a>
                        </p>
                        <p><strong>Вместимость:</strong> <?php echo e($animal->cage->capacity); ?> животных</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Проживает:</strong> <?php echo e($animal->cage->animal_count); ?> животных</p>
                        <p><strong>Свободно:</strong> <?php echo e($animal->cage->free_space); ?> мест</p>
                    </div>
                </div>
                
                <?php if($animal->cage->description): ?>
                    <hr>
                    <p><strong>Описание клетки:</strong></p>
                    <p><?php echo e($animal->cage->description); ?></p>
                <?php endif; ?>
                
                <!-- Прогресс-бар заполненности клетки -->
                <hr>
                <p><strong>Заполненность клетки:</strong></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" 
                         style="width: <?php echo e($animal->cage->capacity > 0 ? ($animal->cage->animal_count / $animal->cage->capacity) * 100 : 0); ?>%">
                        <?php echo e($animal->cage->capacity > 0 ? round(($animal->cage->animal_count / $animal->cage->capacity) * 100) : 0); ?>%
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Действия -->
        <div class="card mt-3">
            <div class="card-body">
                <h6><i class="bi bi-gear"></i> Действия</h6>
                <div class="d-grid gap-2 d-md-flex">
                    <a href="<?php echo e(route('cages.show', $animal->cage)); ?>" class="btn btn-outline-success me-md-2">
                        <i class="bi bi-house"></i> Посмотреть клетку
                    </a>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('animals.edit', $animal)); ?>" class="btn btn-outline-primary me-md-2">
                            <i class="bi bi-pencil"></i> Редактировать животное
                        </a>
                        <form action="<?php echo e(route('animals.destroy', $animal)); ?>" method="POST" 
                              onsubmit="return confirm('Вы уверены, что хотите удалить это животное?')" 
                              class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash"></i> Удалить животное
                            </button>
                        </form>
                    <?php else: ?>
                        <p class="text-muted text-center flex-grow-1">
                            <i class="bi bi-info-circle"></i> 
                            Для управления животными необходимо войти в систему
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\karaz\OneDrive\Desktop\задание1\resources\views/animals/show.blade.php ENDPATH**/ ?>