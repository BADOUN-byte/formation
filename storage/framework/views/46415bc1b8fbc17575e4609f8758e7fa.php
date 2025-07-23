

<?php $__env->startSection('title', 'Ajouter un service'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="card shadow rounded p-4 bg-light">
        <h2 class="fw-bold mb-4 text-primary">
            ➕ Ajouter un service
        </h2>

        <form 
            action="<?php echo e(isset($direction) 
                        ? route('admin.directions.services.store', $direction) 
                        : route('admin.services.store')); ?>" 
            method="POST"
            class="row g-3"
        >
            <?php echo csrf_field(); ?>

            <div class="col-md-6">
                <label for="nom" class="form-label">Nom du service</label>
                <input type="text" 
                       name="nom" 
                       id="nom" 
                       class="form-control <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       value="<?php echo e(old('nom')); ?>" 
                       required>
                <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <?php if(isset($direction)): ?>
                <div class="col-md-6">
                    <label class="form-label">Direction</label>
                    <input type="text" class="form-control" value="<?php echo e($direction->nom); ?>" disabled>
                    <input type="hidden" name="direction_id" value="<?php echo e($direction->id); ?>">
                </div>
            <?php else: ?>
                <div class="col-md-6">
                    <label for="direction_id" class="form-label">Direction</label>
                    <select name="direction_id" 
                            id="direction_id"
                            class="form-select <?php $__errorArgs = ['direction_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required>
                        <option value="">-- Choisir une direction --</option>
                        <?php $__currentLoopData = $directions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($dir->id); ?>"
                                    <?php echo e(old('direction_id') == $dir->id ? 'selected' : ''); ?>>
                                <?php echo e($dir->nom); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['direction_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            <?php endif; ?>

            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    rows="3"
                ><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-12 d-flex justify-content-between mt-4">
                <a href="<?php echo e(isset($direction) 
                        ? route('admin.directions.services.index', $direction) 
                        : route('admin.services.index')); ?>" 
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/services/create.blade.php ENDPATH**/ ?>