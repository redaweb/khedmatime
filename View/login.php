<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Connexion - Khedema+pay</title>
</head>
<body class="bg-white font-sans antialiased">

    <div class="flex min-h-screen">
        
        <div class="hidden lg:block lg:w-1/2 relative">
            <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=1000" 
                 alt="Bricoleur" 
                 class="absolute inset-0 h-full w-full object-cover">
        </div>

        <div class="w-full lg:w-1/2 flex flex-col p-8 lg:p-12">
            
            <div class="flex justify-between items-center mb-12">
                <a href="index.php" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Retour à la page d'accueil
                </a>
            </div>

            <div class="flex-grow flex flex-col justify-center max-w-md mx-auto w-full">
                <div class="text-center mb-8">
                    <div class="flex justify-center items-center mb-6">
                        <span class="text-4xl font-bold tracking-tighter text-blue-700">Khedema+pay</span>
                    </div>
                    
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Connectez-vous à votre compte</h1>
                    <p class="text-gray-600 text-sm">
                        Content de te revoir ! Veuillez entrer vos identifiants pour accéder à votre compte.
                    </p>
                </div>

                <form class="space-y-4" action="../model/login.php" method="POST">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="tel" name="telephone" required placeholder="07xxxxx" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                            <a href="#" class="text-xs text-orange-600 hover:text-orange-700 hover:underline">Mot de passe oublié ?</a>
                        </div>
                        <input type="password" name="password" required placeholder="••••••••" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-md transition duration-200 mt-2">
                        Se connecter
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Vous n'avez pas de compte ? 
                        <a href="inscription.php" class="font-bold text-blue-700 hover:text-blue-800 hover:underline transition">
                            Inscrivez-vous
                        </a>
                    </p>
                </div>

                <p class="mt-8 text-center text-xs text-gray-500 leading-relaxed">
                    En cliquant sur Se connecter, vous acceptez notre 
                    <a href="#" class="underline hover:text-gray-700">Termes et conditions</a> et 
                    <a href="#" class="underline hover:text-gray-700">Politique de confidentialité</a>.
                </p>
            </div>
        </div>
    </div>

</body>
</html>