

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Détails du service</h1>

    <div class="card mb-3">
        <div class="card-header">
            <strong><?php echo e($service->nom); ?></strong>
        </div>
        <div class="card-body">
            <p><strong>Description :</strong> <?php echo e($service->description ?? 'Aucune description'); ?></p>
            <p><strong>Direction :</strong> <?php echo e($service->direction->nom); ?></p>
        </div>
    </div>

    <a href="<?php echo e(route('admin.services.index')); ?>" class="btn btn-secondary">← Retour à la liste des services</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/services/show.blade.php ENDPATH**/ ?>