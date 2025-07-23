

<?php $__env->startSection('title', 'Services'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">📂 Liste des services</h1>
        <div>
            <a href="<?php echo e(route('admin.directions.index')); ?>" class="btn btn-secondary me-2">← Retour aux directions</a>
            <a href="<?php echo e(route('admin.services.create')); ?>" class="btn btn-success">➕ Ajouter un service</a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    <?php endif; ?>

    <?php if(isset($direction)): ?>
        <div class="alert alert-info mb-3">
            Services filtrés par la direction : <strong><?php echo e($direction->nom); ?></strong>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Direction</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($service->nom); ?></td>
                        <td><?php echo e(Str::limit(strip_tags($service->description), 100)); ?></td>
                        <td><?php echo e($service->direction->nom ?? '—'); ?></td>
                        <td class="text-center">
                            <a href="<?php echo e(route('admin.services.show', $service)); ?>" class="btn btn-info btn-sm me-1">👁️</a>
                            <a href="<?php echo e(route('admin.services.edit', $service)); ?>" class="btn btn-primary btn-sm me-1">✏️</a>
                            <form action="<?php echo e(route('admin.services.destroy', $service)); ?>" method="POST" class="d-inline"
                                onsubmit="return confirm('Confirmer la suppression de ce service ?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Aucun service à afficher.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <?php echo e($services->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/services/index.blade.php ENDPATH**/ ?>