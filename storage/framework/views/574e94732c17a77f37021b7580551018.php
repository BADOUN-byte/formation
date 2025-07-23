<h2>Mes Formations</h2>
<?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="background-color: #eee; padding: 10px; margin-bottom: 10px;">
        <strong><?php echo e($formation->titre); ?></strong><br>
        <em><?php echo e($formation->description); ?></em><br>
        <a href="<?php echo e(route('admin.formations.show', $formation)); ?>">📂 Détails</a>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/formations/mes_formations.blade.php ENDPATH**/ ?>