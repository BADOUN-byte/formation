

<?php $__env->startSection('title', 'Tableau de bord'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1>Bienvenue <?php echo e(auth()->user()->prenom); ?> <?php echo e(auth()->user()->nom); ?></h1>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-danger">Se déconnecter</button>
        </form>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Bienvenue sur la plateforme de gestion des formations de la DGTI</li>
    </ol>

    
    <div class="row mb-4">
    <?php $__currentLoopData = $directions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$direction, $color]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $slug = Str::slug($direction);
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-<?php echo e($color); ?> text-white h-100">
                <div class="card-body">Formations <?php echo e($direction); ?></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="<?php echo e(route('formations.direction.index', ['direction' => $slug])); ?>">
                        Voir les formations
                    </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

    
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-users me-1"></i> Liste des utilisateurs de la plateforme</div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($user->nom); ?></td>
                                <td><?php echo e($user->prenom); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e(optional($user->role)->nom ?? 'Non défini'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            <div class="d-flex justify-content-center mt-3">
                <?php echo e($users->links()); ?>

            </div>
        </div>
    </div>

    
    <div class="card my-4">
        <div class="card-header"><i class="fas fa-comments me-1"></i> Derniers commentaires</div>
        <div class="card-body">
            <?php if($comments->isEmpty()): ?>
                <p class="text-muted">Aucun commentaire pour le moment.</p>
            <?php else: ?>
                <ul class="list-group mb-3">
                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                            <strong><?php echo e(optional($comment->user)->prenom); ?> <?php echo e(optional($comment->user)->nom); ?></strong>
                            <small class="text-muted d-block">le <?php echo e($comment->created_at->format('d/m/Y H:i')); ?></small>
                            <p class="mb-0"><?php echo e($comment->contenu); ?></p>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>

            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/dashboard.blade.php ENDPATH**/ ?>