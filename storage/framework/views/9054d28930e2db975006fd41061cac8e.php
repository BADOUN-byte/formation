

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Commentaires des utilisateurs</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <!-- Formulaire d'ajout de commentaire -->
    <div class="card mb-4">
        <div class="card-header">Ajouter un commentaire</div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('commentaires.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="contenu" class="form-label">Contenu</label>
                    <textarea name="contenu" id="contenu" class="form-control <?php $__errorArgs = ['contenu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="4" required><?php echo e(old('contenu')); ?></textarea>
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
                <button type="submit" class="btn btn-primary">Publier</button>
            </form>
        </div>
    </div>

    <!-- Liste des commentaires -->
    <div class="card">
        <div class="card-header">Tous les commentaires</div>
        <div class="card-body">
            <?php $__empty_1 = true; $__currentLoopData = $commentaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="border rounded p-3 mb-3">
                    <p><?php echo e($comment->contenu); ?></p>
                    <small class="text-muted">
                        Posté par <?php echo e($comment->user->prenom ?? 'Utilisateur inconnu'); ?> <?php echo e($comment->user->nom ?? ''); ?>

                        le <?php echo e($comment->created_at->format('d/m/Y à H:i')); ?>

                    </small>

                    <?php if(auth()->id() === $comment->user_id || auth()->user()->isAdmin()): ?>
                        <form method="POST" action="<?php echo e(route('commentaires.destroy', $comment)); ?>" class="mt-2">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce commentaire ?')">Supprimer</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>Aucun commentaire pour le moment.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/commentaires/index.blade.php ENDPATH**/ ?>