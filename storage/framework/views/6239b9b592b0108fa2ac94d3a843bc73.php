<h3><?php echo e($direction->nom); ?></h3>

<?php if($direction->description): ?>
    <p><?php echo e($direction->description); ?></p>
<?php endif; ?>

<h4>Services</h4>
<?php if($direction->services->count()): ?>
    <ul>
        <?php $__currentLoopData = $direction->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($service->nom); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php else: ?>
    <p>Aucun service trouvé.</p>
<?php endif; ?>

<h4>Formations</h4>
<?php if($direction->formations->count()): ?>
    <ul>
        <?php $__currentLoopData = $direction->formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($formation->nom); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php else: ?>
    <p>Aucune formation trouvée.</p>
<?php endif; ?>
<?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/directions/detail.blade.php ENDPATH**/ ?>