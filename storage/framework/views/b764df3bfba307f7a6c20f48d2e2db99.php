

<?php $__env->startSection('title', 'Животные - Виртуальный зоопарк'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="bi bi-heart"></i> Животные зоопарка</h1>
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('animals.create')); ?>" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Добавить животное
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if($animals->count() > 0): ?>
    <div class="row">
        <?php $__currentLoopData = $animals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card animal-card h-100">
                    <?php if($animal->image): ?>
                        <img src="<?php echo e($animal->image_url); ?>" class="card-img-top" 
                             alt="<?php echo e($animal->name); ?>" style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="bi bi-image fs-1 text-muted"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-paw"></i> <?php echo e($animal->name); ?>

                        </h5>
                        <p class="card-text">
                            <strong>Вид:</strong> <?php echo e($animal->species); ?><br>
                            <strong>Возраст:</strong> <?php echo e($animal->age); ?> лет<br>
                            <strong>Клетка:</strong> 
                            <a href="<?php echo e(route('cages.show', $animal->cage)); ?>" class="text-decoration-none">
                                <?php echo e($animal->cage->name); ?>

                            </a>
                        </p>
                        
                        <?php if($animal->description): ?>
                            <p class="card-text">
                                <small class="text-muted"><?php echo e(Str::limit($animal->description, 100)); ?></small>
                            </p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-footer">
                        <div class="btn-group w-100" role="group">
                            <a href="<?php echo e(route('animals.show', $animal)); ?>" class="btn btn-outline-primary">
                                <i class="bi bi-eye"></i> Подробнее
                            </a>
                            <?php if(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('animals.edit', $animal)); ?>" class="btn btn-outline-secondary">
                                    <i class="bi bi-pencil"></i> Редактировать
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="bi bi-heart fs-1"></i>
                <h4>В зоопарке пока нет животных</h4>
                <p>Добавьте первое животное в зоопарк!</p>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('animals.create')); ?>" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Добавить животное
                    </a>
                <?php else: ?>
                    <p class="text-muted">Для добавления животных необходимо войти в систему</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\karaz\OneDrive\Desktop\задание1\resources\views/animals/index.blade.php ENDPATH**/ ?>