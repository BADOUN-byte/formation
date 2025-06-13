<?php $__env->startSection('title', 'Bienvenue'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="text-center my-4 text-primary">Bienvenue sur la plateforme de gestion des formations</h1>

    
    <div class="mb-5 p-4 bg-info text-white rounded">
        <h2 class="text-uppercase">📂 DGTI</h2>
        <ul class="list-group list-group-flush">
            <?php $__empty_1 = true; $__currentLoopData = $directions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $direction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="list-group-item">
                    <strong><?php echo e($direction->nom ?? 'Aucune direction'); ?></strong>

                    <?php if($direction->services && $direction->services->isNotEmpty()): ?>
                        <ul class="ms-4 mt-2">
                            <?php $__currentLoopData = $direction->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <span class="text-success"><?php echo e($service->nom); ?></span>

                                    <?php if($service->formations && $service->formations->isNotEmpty()): ?>
                                        <ul class="ms-3">
                                            <?php $__currentLoopData = $service->formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="text-muted">
                                                    <?php echo e($formation->titre); ?>

                                                    (<?php echo e(optional($formation->date_debut)->format('d/m/Y')); ?>)
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php else: ?>
                                        <em class="text-muted">Aucune formation</em>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <em class="text-muted">Aucun service</em>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="list-group-item text-muted">Aucune direction disponible.</li>
            <?php endif; ?>
        </ul>
    </div>

    
    <div class="mb-5 p-4 bg-warning text-dark rounded">
        <h2 class="text-uppercase">📘 Statut des formations</h2>
        <ul class="mb-0">
            <li>📘 Formations passées : <?php echo e($formationsPassees); ?></li>
            <li>📗 Formations en cours : <?php echo e($formationsEnCours); ?></li>
            <li>📙 Formations à venir : <?php echo e($formationsAVenir); ?></li>
        </ul>
    </div>

    
    <div class="mb-5 p-4 bg-success text-white rounded">
        <h2 class="text-uppercase">📊 Statistiques</h2>
        <p>Données sur les participations, taux de réussite, etc.</p>
    </div>

    
    <div class="card my-4">
        <div class="card-header">
            <i class="fas fa-comments me-1"></i> Derniers commentaires
        </div>
        <div class="card-body">
            <?php if($comments->isEmpty()): ?>
                <p>Aucun commentaire pour le moment.</p>
            <?php else: ?>
                <ul class="list-group mb-3">
                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                            <strong><?php echo e(optional($comment->user)->prenom); ?> <?php echo e(optional($comment->user)->nom); ?></strong>
                            <small class="text-muted">le <?php echo e($comment->created_at->format('d/m/Y H:i')); ?></small>
                            <p><?php echo e($comment->contenu); ?></p>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>
                
                <form method="POST" action="<?php echo e(route('commentaires.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="contenu" class="form-label">Ajouter un commentaire</label>
                        <textarea class="form-control <?php $__errorArgs = ['contenu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="contenu" name="contenu" rows="3" required><?php echo e(old('contenu')); ?></textarea>
                        <?php $__errorArgs = ['contenu'];
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
                    
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            <?php else: ?>
                <div class="alert alert-info mt-3">
                    <a href="<?php echo e(route('login')); ?>">Connectez-vous</a> pour laisser un commentaire.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/welcome.blade.php ENDPATH**/ ?>