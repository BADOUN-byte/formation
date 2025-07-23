<h2>Choisissez une Formation</h2>
<?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <strong><?php echo e($formation->titre); ?></strong><br>
        <em><?php echo e($formation->description); ?></em><br>
        <form action="<?php echo e(route('participant.formations.inscrire', $formation)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit">S'inscrire</button>
            <?php if(session('success')): ?>
    <div style="color: green;"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('info')): ?>
    <div style="color: orange;"><?php echo e(session('info')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div style="color: red;"><?php echo e(session('error')); ?></div>
<?php endif; ?>

        </form>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/formations/participant.blade.php ENDPATH**/ ?>