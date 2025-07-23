

<?php $__env->startSection('title', 'Tableau de bord'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $currentUser = Auth::user();
?>

<div class="container py-4 position-relative">
    
    <div class="mb-4 text-center mt-5">
        <h1 class="display-3 text-primary fw-bold">
            BIENVENUE <?php echo e($currentUser->prenom); ?> <?php echo e($currentUser->nom); ?>

        </h1>
        <p class="lead text-secondary text-uppercase">
            Rôle : <?php echo e($currentUser->role->nom ?? 'Utilisateur'); ?>

        </p>
        <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-sm btn-outline-danger mt-2">🚪 Se déconnecter</button>
        </form>
    </div>

    <?php if($currentUser->isAdmin()): ?>

        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>🏢 Directions</span>
                <a href="<?php echo e(route('admin.directions.create')); ?>" class="btn btn-sm btn-outline-light">➕ Ajouter</a>
            </div>
            <ul class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $directions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $direction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo e($direction->nom); ?>

                        <div class="btn-group btn-group-sm">
                            <a href="<?php echo e(route('admin.directions.edit', $direction->id)); ?>" class="btn btn-outline-secondary">✏️</a>
                            <form action="<?php echo e(route('admin.directions.destroy', $direction->id)); ?>" method="POST" onsubmit="return confirm('Supprimer cette direction ?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-outline-danger">🗑️</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item text-muted">Aucune direction trouvée.</li>
                <?php endif; ?>
            </ul>
        </div>

        
        <div class="card mb-4">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <span>🧩 Services</span>
                <a href="<?php echo e(route('admin.services.create')); ?>" class="btn btn-sm btn-outline-light">➕ Ajouter</a>
            </div>
            <ul class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo e($service->nom); ?> <small class="text-muted">(<?php echo e($service->direction->nom); ?>)</small>
                        <div class="btn-group btn-group-sm">
                            <a href="<?php echo e(route('admin.services.edit', $service->id)); ?>" class="btn btn-outline-secondary">✏️</a>
                            <form action="<?php echo e(route('admin.services.destroy', $service->id)); ?>" method="POST" onsubmit="return confirm('Supprimer ce service ?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-outline-danger">🗑️</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item text-muted">Aucun service trouvé.</li>
                <?php endif; ?>
            </ul>
        </div>

        
        <div class="card mb-4">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <span>📅 Formations</span>
                <a href="<?php echo e(route('admin.formations.create')); ?>" class="btn btn-sm btn-outline-light">➕ Ajouter</a>
            </div>
            <ul class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo e($formation->titre); ?> <small class="text-muted">(<?php echo e($formation->formateur->name ?? 'Sans formateur'); ?>)</small>
                        <div class="btn-group btn-group-sm">
                            <a href="<?php echo e(route('admin.formations.edit', $formation->id)); ?>" class="btn btn-outline-secondary">✏️</a>
                            <form action="<?php echo e(route('admin.formations.destroy', $formation->id)); ?>" method="POST" onsubmit="return confirm('Supprimer cette formation ?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-outline-danger">🗑️</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item text-muted">Aucune formation trouvée.</li>
                <?php endif; ?>
            </ul>
        </div>

        
        <div class="card mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span>👥 Utilisateurs</span>
                <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-sm btn-outline-light">➕ Ajouter</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($user->nom); ?></td>
                                <td><?php echo e($user->prenom); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td class="text-uppercase"><?php echo e($user->role->nom ?? 'Non défini'); ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-outline-secondary">✏️</a>
                                        <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-outline-danger">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="5" class="text-center text-muted">Aucun utilisateur trouvé.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/dashboard.blade.php ENDPATH**/ ?>