

<?php $__env->startSection('content'); ?>
<h1>Créer une nouvelle direction</h1>

<form action="<?php echo e(route('directions.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div>
        <label for="nom">Nom de la direction :</label>
        <input type="text" id="nom" name="nom" required>
    </div>
    <button type="submit">Créer</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/directions/create.blade.php ENDPATH**/ ?>