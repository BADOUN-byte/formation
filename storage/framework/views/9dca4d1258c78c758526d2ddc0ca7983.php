

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Créer une formation</h1>

    <form action="<?php echo e(route('admin.formations.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="row">
            <!-- Titre -->
            <div class="col-md-6 mb-3">
                <label for="titre">Titre :</label>
                <input id="titre" type="text" name="titre" class="form-control" value="<?php echo e(old('titre')); ?>" required>
                <?php $__errorArgs = ['titre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Description -->
            <div class="col-md-6 mb-3">
                <label for="description">Description :</label>
                <textarea id="description" name="description" class="form-control" required><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Type -->
            <div class="col-md-6 mb-3">
                <label for="type">Type :</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="">-- Choisir un type --</option>
                    <?php $__currentLoopData = ['présentiel', 'distanciel', 'hybride']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type); ?>" <?php echo e(old('type') == $type ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Date début -->
            <div class="col-md-6 mb-3">
                <label for="date_debut">Date début :</label>
                <input id="date_debut" type="date" name="date_debut" class="form-control" value="<?php echo e(old('date_debut')); ?>" required>
                <?php $__errorArgs = ['date_debut'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Date fin -->
            <div class="col-md-6 mb-3">
                <label for="date_fin">Date fin :</label>
                <input id="date_fin" type="date" name="date_fin" class="form-control" value="<?php echo e(old('date_fin')); ?>" required>
                <?php $__errorArgs = ['date_fin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Lieu -->
            <div class="col-md-6 mb-3">
                <label for="lieu">Lieu :</label>
                <input id="lieu" type="text" name="lieu" class="form-control" value="<?php echo e(old('lieu')); ?>" required>
                <?php $__errorArgs = ['lieu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Volume horaire -->
            <div class="col-md-6 mb-3">
                <label for="volume_horaire">Volume horaire (heures) :</label>
                <input id="volume_horaire" type="number" name="volume_horaire" class="form-control" value="<?php echo e(old('volume_horaire')); ?>" min="1" required>
                <?php $__errorArgs = ['volume_horaire'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Statut -->
            <div class="col-md-6 mb-3">
                <label for="statut">Statut :</label>
                <select id="statut" name="statut" class="form-control" required>
                    <option value="">-- Choisir un statut --</option>
                    <?php $__currentLoopData = ['en_attente', 'en_cours', 'terminee', 'annulee']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($statut); ?>" <?php echo e(old('statut') == $statut ? 'selected' : ''); ?>><?php echo e(ucfirst($statut)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['statut'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Direction -->
            <div class="col-md-6 mb-3">
                <label for="direction_id">Direction :</label>
                <select id="direction_id" name="direction_id" class="form-control" required>
                    <option value="">-- Choisir une direction --</option>
                    <?php $__currentLoopData = $directions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $direction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($direction->id); ?>" <?php echo e(old('direction_id') == $direction->id ? 'selected' : ''); ?>>
                            <?php echo e($direction->nom); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['direction_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Services -->
            <div class="col-md-6 mb-3">
                <label for="services">Services :</label>
                <select id="services" name="services[]" multiple class="form-control">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($service->id); ?>" data-direction-id="<?php echo e($service->direction_id); ?>"
                            <?php echo e(collect(old('services'))->contains($service->id) ? 'selected' : ''); ?>>
                            <?php echo e($service->nom); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['services'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php $__errorArgs = ['services.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Formateur -->
            <div class="col-md-6 mb-3">
                <label for="formateur_id">Formateur :</label>
                <select id="formateur_id" name="formateur_id" class="form-control" required>
                    <option value="">-- Choisir un formateur --</option>
                    <?php $__currentLoopData = $formateurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formateur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($formateur->id); ?>" <?php echo e(old('formateur_id') == $formateur->id ? 'selected' : ''); ?>>
                            <?php echo e($formateur->nom); ?> <?php echo e($formateur->prenom); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['formateur_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Participants -->
            <div class="col-md-6 mb-3">
                <label for="participants">Participants :</label>
                <select id="participants" name="participants[]" multiple class="form-control">
                    <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($participant->id); ?>" <?php echo e(collect(old('participants'))->contains($participant->id) ? 'selected' : ''); ?>>
                            <?php echo e($participant->nom); ?> <?php echo e($participant->prenom); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['participants'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php $__errorArgs = ['participants.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const directionSelect = document.getElementById('direction_id');
        const serviceSelect = document.getElementById('services');

        function filterServices() {
            const selectedDirectionId = directionSelect.value;

            Array.from(serviceSelect.options).forEach(option => {
                if (!option.value) {
                    option.hidden = false;
                    option.disabled = false;
                    return;
                }
                if (option.getAttribute('data-direction-id') === selectedDirectionId) {
                    option.hidden = false;
                    option.disabled = false;
                } else {
                    option.hidden = true;
                    option.disabled = true;
                    option.selected = false;
                }
            });
        }

        directionSelect.addEventListener('change', filterServices);
        filterServices();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/formations/create.blade.php ENDPATH**/ ?>