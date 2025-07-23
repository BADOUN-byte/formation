

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1>Ajouter un participant à la formation</h1>

    <div class="mb-3">
        <p><strong>Formation :</strong> <?php echo e($formation->titre); ?></p>
    </div>

    <form method="POST" action="<?php echo e(route('admin.formations.participants.store', $formation->id)); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-group mb-3">
            <label for="participant_id">Sélectionner un participant :</label>
            <select name="participant_id" id="participant_id" class="form-control" required>
                <option value="">-- Choisissez un participant --</option>
                <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($participant->id); ?>">
                        <?php echo e($participant->nom); ?> <?php echo e($participant->prenom); ?> (<?php echo e($participant->email); ?>)
                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['participant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="<?php echo e(route('admin.formations.show', $formation->id)); ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/formations/ajouter_participant.blade.php ENDPATH**/ ?>