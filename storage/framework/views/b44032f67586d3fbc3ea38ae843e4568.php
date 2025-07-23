

<?php $__env->startSection('content'); ?>
<div class="container mt-4" style="max-width: 600px;">
    <h1 class="mb-4">Modifier l'utilisateur</h1>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <form method="POST" action="<?php echo e(route('admin.users.update', $user)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="mb-3">
            <label for="nom" class="form-label">Nom *</label>
            <input type="text" name="nom" id="nom" class="form-control" value="<?php echo e(old('nom', $user->nom)); ?>" required>
        </div>

        
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom *</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo e(old('prenom', $user->prenom)); ?>" required>
        </div>

        
        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required>
        </div>

        
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule</label>
            <input type="text" name="matricule" id="matricule" class="form-control" value="<?php echo e(old('matricule', $user->matricule)); ?>">
        </div>

        
        <div class="mb-3">
            <label for="grade" class="form-label">Grade</label>
            <input type="text" name="grade" id="grade" class="form-control" value="<?php echo e(old('grade', $user->grade)); ?>">
        </div>

        
        <div class="mb-3">
            <label for="fonction" class="form-label">Fonction</label>
            <input type="text" name="fonction" id="fonction" class="form-control" value="<?php echo e(old('fonction', $user->fonction)); ?>">
        </div>

        
        <div class="mb-3">
            <label for="role_id" class="form-label">Rôle *</label>
            <select name="role_id" id="role_id" class="form-select" required>
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($role->id); ?>" <?php echo e(old('role_id', $user->role_id) == $role->id ? 'selected' : ''); ?>>
                        <?php echo e(ucfirst($role->nom)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div class="mb-3">
            <label for="service_id" class="form-label">Service</label>
            <select name="service_id" id="service_id" class="form-select">
                <option value="">-- Aucun --</option>
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($service->id); ?>" <?php echo e(old('service_id', $user->service_id) == $service->id ? 'selected' : ''); ?>>
                        <?php echo e($service->nom); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe (laisser vide si inchangé)</label>
            <input type="password" name="password" id="password" class="form-control" minlength="6">
        </div>

        
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Mettre à jour
            </button>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Annuler
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/users/edit.blade.php ENDPATH**/ ?>