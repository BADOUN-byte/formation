

<?php $__env->startSection('content'); ?>
    <h1>Liste des formations</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
    <?php if(auth()->user()->role_id === \App\Models\Role::ADMIN || auth()->user()->role_id === \App\Models\Role::FORMATEUR): ?>
        <a href="<?php echo e(route('admin.formations.create')); ?>" class="btn btn-primary">Créer une formation</a>
    <?php endif; ?>
<?php endif; ?>


    <ul>
        <?php $__empty_1 = true; $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li>
                <a href="<?php echo e(route('admin.formations.show', $formation->id)); ?>">
                    <strong><?php echo e($formation->titre); ?></strong> — 
                    <?php echo e($formation->type); ?> — 
                    <?php echo e($formation->lieu); ?> — 
                    Du <?php echo e(optional($formation->date_debut)->format('d/m/Y')); ?> 
                    au <?php echo e(optional($formation->date_fin)->format('d/m/Y')); ?>

                </a>
                (Formateur : <?php echo e(optional($formation->formateur)->nom ?? 'N/A'); ?>)
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>Aucune formation disponible.</li>
        <?php endif; ?>
    </ul>

    <div class="mt-4">
        <?php echo e($formations->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/formations/index.blade.php ENDPATH**/ ?>