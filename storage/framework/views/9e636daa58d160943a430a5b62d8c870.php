<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DGTI - Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slide-left-right {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(20px); }
        }
        .welcome-message {
            animation: slide-left-right 4s ease-in-out infinite;
        }

        @keyframes rotate-around {
            0% { transform: rotate(0deg) translateX(50px) rotate(0deg); }
            100% { transform: rotate(360deg) translateX(50px) rotate(-360deg); }
        }
        .orbit {
            animation: rotate-around 10s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform-origin: -50px center;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    
    <header class="flex justify-between items-start px-8 py-4 bg-white shadow-md relative">
        <div class="flex flex-col space-y-2">
            
            <div class="flex items-center space-x-4">
                <img src="<?php echo e(asset('assets/img/image.png')); ?>" alt="Logo DGTI" class="w-20 h-20 object-contain" />
                <h1 class="text-lg font-bold text-blue-900 uppercase whitespace-nowrap overflow-visible">
                    DIRECTION GÉNÉRALE DES TRANSMISSIONS ET DE L'INFORMATIQUE (DGTI)
                </h1>
            </div>

            
            <div class="flex items-center gap-6 mt-2">
                <div class="relative w-24 h-24">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                        <img src="<?php echo e(asset('images/formateur.svg')); ?>" alt="Formateur" class="w-12 h-12 rounded-full border-2 border-blue-700 shadow-md object-cover" />
                    </div>
                    <?php for($i = 0; $i < 5; $i++): ?>
                        <div class="orbit" style="animation-delay: <?php echo e($i * 2); ?>s; transform-origin: -50px center;">
                            <img src="<?php echo e(asset('images/bonhomme.svg')); ?>" alt="Participant <?php echo e($i + 1); ?>" class="w-8 h-8 rounded-full border border-blue-400 shadow-sm object-cover"
                                 style="transform: rotate(<?php echo e(72 * $i); ?>deg) translateX(50px) rotate(-<?php echo e(72 * $i); ?>deg);" />
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="welcome-message text-blue-800 font-semibold uppercase text-sm max-w-xs">
                    Bienvenue sur le site des formations de la DGTI / MSECU / BURKINA FASO
                </div>
            </div>
        </div>

        
        <nav class="mt-2">
            <ul class="flex items-center space-x-6 text-blue-700 font-semibold">
                <li><a href="<?php echo e(url('/')); ?>" class="hover:text-blue-900">Accueil</a></li>
                <li>
                    <a href="<?php echo e(route('login')); ?>"
                       class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-900 transition">
                        Se connecter
                    </a>
                </li>
            </ul>
            <div class="flex justify-center mt-4">
                <a href="<?php echo e(route('register')); ?>" class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">
                    Créer un compte
                </a>
            </div>
        </nav>
    </header>

  <main class="flex-grow flex flex-col md:flex-row items-stretch justify-between max-w-full mx-auto min-h-[calc(100vh-5rem-4rem)]">
    
    <div class="md:w-1/2 w-full flex justify-start items-center">
        <img 
            src="<?php echo e(asset('assets/img/imaag.png')); ?>" 
            alt="Image Accueil" 
            class="h-full w-auto max-h-[calc(100vh-5rem-4rem)] object-contain rounded-lg shadow-lg"
        />
    </div>

    
    <div class="md:w-1/2 w-full bg-white p-8 rounded-lg shadow-lg flex flex-col justify-center">
        <h2 class="text-2xl font-bold text-center mb-6 text-blue-800">Connexion</h2>

        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label for="email" class="block mb-2 font-semibold text-gray-700">Email :</label>
                <input id="email" type="email" name="email" required autofocus
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                       value="<?php echo e(old('email')); ?>">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="password" class="block mb-2 font-semibold text-gray-700">Mot de passe :</label>
                <input id="password" type="password" name="password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit"
                    class="w-full bg-blue-700 text-white py-2 rounded-md font-semibold hover:bg-blue-900 transition">
                Se connecter
            </button>

            <?php if(Route::has('password.request')): ?>
                <div class="text-center">
                    <a class="text-sm text-blue-600 hover:underline mt-2 inline-block" href="<?php echo e(route('password.request')); ?>">
                        Mot de passe oublié ?
                    </a>
                </div>
            <?php endif; ?>

            <div class="text-center mt-6">
                <a href="<?php echo e(route('register')); ?>" class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded inline-block">
                    Créer un compte
                </a>
            </div>
        </form>
    </div>
</main>


    
    <footer class="bg-gray-100 py-4 text-center text-gray-700 font-bold flex flex-col items-center gap-2">
        <div class="flex items-center gap-2">
            <img src="<?php echo e(asset('assets/img/immm.png')); ?>" alt="Drapeau Burkina Faso" class="w-10 h-8 object-contain" />
            <span>2025 – Version 1.0 – © DGTI</span>
        </div>
        <span>Contact : nadountabadoun@gmail.com</span>
    </footer>

</body>
</html>
<?php /**PATH C:\PROJET LARAVEL2025\Formation\resources\views/welcome.blade.php ENDPATH**/ ?>