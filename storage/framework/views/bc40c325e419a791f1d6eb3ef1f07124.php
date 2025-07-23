

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">Liste des utilisateurs</h2>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                     <td><?php echo e($user->nom); ?> <?php echo e($user->prenom); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->role->nom ?? 'Non défini'); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-sm btn-primary">Modifier</a>

                        <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" style="display: inline-block;" onsubmit="return confirm('Confirmer la suppression ?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">Aucun utilisateur trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/users/index.blade.php ENDPATH**/ ?>