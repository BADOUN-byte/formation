

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Créer un compte</h2>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <li><?php echo e($error); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="POST" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="<?php echo e(old('nom')); ?>">
        </div>

        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" value="<?php echo e(old('prenom')); ?>">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>">
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/auth/register.blade.php ENDPATH**/ ?>