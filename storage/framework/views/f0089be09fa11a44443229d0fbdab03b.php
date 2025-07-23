

<?php $__env->startPush('styles'); ?>
<style>
    .card-hover:hover {
        transform: scale(1.03);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease-in-out;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4 fw-bold">📂 Liste des Directions</h1>

    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDirectionModal">
            <i class="fas fa-plus-circle me-1"></i> Ajouter une direction
        </button>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <div class="row mb-5">
        <?php $__currentLoopData = $directions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $direction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $bgMap = [
                    'DGTI' => 'primary',
                    'DSI' => 'success',
                    'DESF' => 'warning',
                    'DASP' => 'info',
                    'DT'   => 'danger',
                    'DIG'  => 'secondary',
                ];
                $iconMap = [
                    'DGTI' => 'fa-building',
                    'DSI' => 'fa-network-wired',
                    'DESF' => 'fa-university',
                    'DASP' => 'fa-briefcase',
                    'DT'   => 'fa-cogs',
                    'DIG'  => 'fa-globe',
                ];
                $name = strtoupper($direction->nom);
                $bgColor = $bgMap[$name] ?? 'dark';
                $icon = $iconMap[$name] ?? 'fa-sitemap';
                $text = in_array($bgColor, ['warning', 'info', 'light']) ? 'text-dark' : 'text-white';
                $formationCount = $direction->formations->count();
            ?>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-hover <?php echo e($text); ?> bg-<?php echo e($bgColor); ?> shadow h-100 d-flex flex-column">
                    <div class="card-body text-center">
                        <h2 class="fw-bold text-uppercase">
                            <i class="fas <?php echo e($icon); ?> me-2"></i> <?php echo e($direction->nom); ?>

                        </h2>
                        <span class="badge bg-light text-dark mt-2">
                            <?php echo e($formationCount); ?> formation<?php echo e($formationCount > 1 ? 's' : ''); ?>

                        </span>
                    </div>

                    <div class="flex-grow-1"></div>

                    <div class="card-footer bg-transparent border-0 d-flex flex-column align-items-center gap-2">
                        <button type="button" 
                                class="btn btn-outline-light w-100" 
                                data-bs-toggle="modal" 
                                data-bs-target="#detailsModal" 
                                data-id="<?php echo e($direction->id); ?>">
                            📋 Voir détails
                        </button>

                        <div class="d-flex justify-content-between w-100 px-2 pt-2">
                            <a href="<?php echo e(route('admin.directions.edit', $direction->id)); ?>" class="<?php echo e($text); ?>" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('admin.directions.destroy', $direction->id)); ?>" method="POST" onsubmit="return confirm('Supprimer cette direction ?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-link <?php echo e($text); ?> p-0 m-0" title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<!-- Modal détails direction -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Détails direction</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body" id="modal-body-content">
        Chargement...
      </div>
    </div>
  </div>
</div>

<!-- Modal de création -->
<div class="modal fade" id="createDirectionModal" tabindex="-1" aria-labelledby="createDirectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Créer une nouvelle direction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('admin.directions.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nom" name="nom" required value="<?php echo e(old('nom')); ?>">
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
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var detailsModal = document.getElementById('detailsModal');

        detailsModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var directionId = button.getAttribute('data-id');

            // Afficher message de chargement
            document.getElementById('modal-body-content').innerHTML = 'Chargement...';

            fetch(`/directions/${directionId}/detail`)
                .then(res => {
                    if(!res.ok) throw new Error('Erreur réseau');
                    return res.text();
                })
                .then(html => {
                    document.getElementById('modal-body-content').innerHTML = html;
                })
                .catch(() => {
                    document.getElementById('modal-body-content').innerHTML = 'Erreur lors du chargement des détails.';
                });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/directions/index.blade.php ENDPATH**/ ?>