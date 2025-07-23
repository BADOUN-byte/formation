

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <h1 class="mb-4">Détails de la formation</h1>

    <div class="card p-3 mb-4 shadow-sm">
        <p><strong>Titre :</strong> <?php echo e($formation->titre); ?></p>
        <p><strong>Type :</strong> <?php echo e($formation->type); ?></p>
        <p><strong>Lieu :</strong> <?php echo e($formation->lieu); ?></p>
        <p><strong>Date début :</strong> <?php echo e($formation->date_debut->format('d/m/Y')); ?></p>
        <p><strong>Date fin :</strong> <?php echo e($formation->date_fin->format('d/m/Y')); ?></p>
        <p><strong>Volume horaire :</strong> <?php echo e($formation->volume_horaire); ?> heures</p>
        <p><strong>Service :</strong> <?php echo e(optional($formation->service)->nom ?? 'N/A'); ?></p>
        <p><strong>Statut :</strong> <?php echo e(ucfirst($formation->statut ?? 'N/A')); ?></p>
        <p><strong>Formateur :</strong> 
            <?php echo e(optional($formation->formateur)->nom ?? 'N/A'); ?> 
            <?php echo e(optional($formation->formateur)->prenom ?? ''); ?>

        </p>
    </div>

    <h4>Participants</h4>
    <?php if($formation->participants->isEmpty()): ?>
        <p class="text-muted">Aucun participant inscrit.</p>
    <?php else: ?>
        <ul>
            <?php $__currentLoopData = $formation->participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($participant->nom); ?> <?php echo e($participant->prenom); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>

    <div class="mt-4 d-flex flex-wrap gap-2 align-items-center">

        
        <a href="<?php echo e(route('admin.formations.index')); ?>" class="btn btn-secondary">
            ← Retour à la liste
        </a>

        <?php if(auth()->guard()->check()): ?>
            <?php $user = auth()->user(); ?>

            
            <?php if($user->role_id === \App\Models\Role::ADMIN): ?>
                <a href="<?php echo e(route('admin.formations.edit', $formation->id)); ?>" class="btn btn-warning">
                    ✏️ Modifier
                </a>

                <form action="<?php echo e(route('admin.formations.destroy', $formation->id)); ?>" method="POST"
                      onsubmit="return confirm('Confirmer la suppression ?')" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">🗑️ Supprimer</button>
                </form>
            <?php endif; ?>

            
            <?php if($user->role_id === \App\Models\Role::FORMATEUR): ?>
                <a href="<?php echo e(route('admin.formations.participants.add', $formation->id)); ?>" class="btn btn-primary">
                    ➕ Ajouter des participants
                </a>
            <?php endif; ?>

            
            <?php if($user->role_id === \App\Models\Role::PARTICIPANT): ?>
                <form method="POST" action="<?php echo e(route('admin.formations.inscription', $formation->id)); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success">
                        S'inscrire
                    </button>
                </form>

                <a href="<?php echo e(route('formations.commentaires', $formation->id)); ?>" class="btn btn-secondary">
                    💬 Commenter
                </a>
            <?php endif; ?>

        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">
                Connectez-vous pour voir les actions
            </a>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/formations/show.blade.php ENDPATH**/ ?>