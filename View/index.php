<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Khedema+pay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../layout/css/navbar.css">

</head>
    
<body class="font-sans text-gray-800 bg-white">

<?php include '../includes/navbar.php';?>

<section class="relative py-20 px-4 text-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="../img/banner.jpg" alt="Banner" class="w-full h-full object-cover">
    </div>

    <div class="container mx-auto relative z-20">
        <h1 class="text-4xl md:text-6xl font-extrabold text-orange-500 mb-6 drop-shadow-md">
            Trouvez un artisan près de chez vous
        </h1>
        <p class="text-xl md:text-2xl text-blue-900 font-bold mb-10 max-w-3xl mx-auto drop-shadow-sm">
            Réparez votre maison ou votre voiture facilement. <br class="hidden md:block"> Payez en argent ou échangez vos compétences !
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            <a href="#services" class="bg-orange-500 hover:bg-orange-600 text-white text-lg font-bold px-10 py-4 rounded-full shadow-2xl transition duration-300 transform hover:scale-105 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Trouver un artisan
            </a>
            
            <a href="inscription.php" class="bg-white/90 backdrop-blur-sm border-2 border-blue-700 text-blue-700 hover:bg-blue-700 hover:text-white text-lg font-bold px-10 py-4 rounded-full transition duration-300 shadow-lg">
                Devenir prestataire
            </a>
        </div>
    </div>

    <div class="absolute bottom-0 right-0 opacity-10 pointer-events-none transform rotate-12 z-10">
        <svg class="w-40 h-40 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"/></svg>
    </div>
</section>

 <section class="py-12 bg-white">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="p-6 group hover:bg-blue-50 transition duration-300 rounded-xl">
            <div class="text-blue-700 text-4xl mb-4">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3 class="font-bold text-lg mb-2">Proximité</h3>
            <p class="text-sm text-gray-500">Des artisans qualifiés juste au coin de votre rue, partout en Algérie.</p>
        </div>

        <div class="p-6 border-x border-gray-100 group hover:bg-blue-50 transition duration-300 rounded-xl">
            <div class="text-blue-700 text-4xl mb-4">
                <i class="fas fa-hands-helping"></i>
            </div>
            <h3 class="font-bold text-lg mb-2">Échange</h3>
            <p class="text-sm text-gray-500">Payez par service ou échangez vos propres compétences avec l'artisan.</p>
        </div>

        <div class="p-6 group hover:bg-blue-50 transition duration-300 rounded-xl">
            <div class="text-blue-700 text-4xl mb-4">
                <i class="fas fa-user-shield"></i>
            </div>
            <h3 class="font-bold text-lg mb-2">Confiance</h3>
            <p class="text-sm text-gray-500">Profils vérifiés et avis clients réels pour une tranquillité totale.</p>
        </div>
    </div>
</section>

<section class="py-12 container mx-auto px-4">
    <h2 class="text-2xl font-bold text-center mb-10 text-gray-800">Explorez nos services les plus demandés</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="artisans.php?categorie=plomberie">
        <div class="relative group overflow-hidden rounded-2xl shadow-md h-64 cursor-pointer">
            <img src="https://images.unsplash.com/photo-1581244277943-fe4a9c777189?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex flex-col justify-end p-6">
                <span class="text-white font-bold text-lg">Plomberie</span>
                <p class="text-gray-200 text-xs">Réparation, fuite, installation</p>
            </div>
        </div>
        </a>
            <a href="artisans.php?categorie=electricite">
        <div class="relative group overflow-hidden rounded-2xl shadow-md h-64 cursor-pointer">
            <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex flex-col justify-end p-6">
                <span class="text-white font-bold text-lg">Électricité</span>
                <p class="text-gray-200 text-xs">Tableau, câblage, éclairage</p>
            </div>
        </div>
            </a>
        <a href="artisans.php?categorie=climatisation">

        <div class="relative group overflow-hidden rounded-2xl shadow-md h-64 cursor-pointer">
            <img src="https://images.unsplash.com/photo-1590856029826-c7a73142bbf1?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex flex-col justify-end p-6">
                <span class="text-white font-bold text-lg">Climatisation</span>
                <p class="text-gray-200 text-xs">Entretien, recharge, pose</p>
            </div>
        </div>
        </a>
        <a href="artisans.php?categorie=menuiserie">

        <div class="relative group overflow-hidden rounded-2xl shadow-md h-64 cursor-pointer">
            <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex flex-col justify-end p-6">
                <span class="text-white font-bold text-lg">Menuiserie</span>
                <p class="text-gray-200 text-xs">Meubles, portes, décoration bois</p>
            </div>
        </div>
</a>
        <a href="artisans.php?categorie=mecanique">

        <div class="relative group overflow-hidden rounded-2xl shadow-md h-64 cursor-pointer">
            <img src="https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex flex-col justify-end p-6">
                <span class="text-white font-bold text-lg">Mécanique Auto</span>
                <p class="text-gray-200 text-xs">Diagnostic, vidange, réparation</p>
            </div>
        </div>
</a>
        <a href="artisans.php?categorie=peinture">
        <div class="relative group overflow-hidden rounded-2xl shadow-md h-64 cursor-pointer">
            <img src="https://images.unsplash.com/photo-1533090161767-e6ffed986c88?auto=format&fit=crop&q=80&w=600">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex flex-col justify-end p-6">
                <span class="text-white font-bold text-lg">Peinture</span>
                <p class="text-gray-200 text-xs">Intérieur, extérieur, enduit</p>
            </div>
        </div>
        </a>

    </div>
</section>

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4">Comment ça marche</h2>
            <p class="text-center text-gray-600 mb-12">Étapes simples pour résoudre vos problèmes.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&q=80&w=800" class="rounded-xl shadow-xl">
                </div>
                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="bg-blue-700 text-white w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 font-bold">1</div>
                        <div>
                            <h4 class="font-bold text-lg">Choisissez un service</h4>
                            <p class="text-gray-600">Sélectionnez la catégorie de travaux dont vous avez besoin.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="bg-blue-700 text-white w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 font-bold">2</div>
                        <div>
                            <h4 class="font-bold text-lg">Réservez en ligne</h4>
                            <p class="text-gray-600">Consultez le profil de l'artisan et faites votre demande.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="bg-blue-700 text-white w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 font-bold">3</div>
                        <div>
                            <h4 class="font-bold text-lg">Détendez-vous</h4>
                            <p class="text-gray-600">L'artisan arrive chez vous et s'occupe de tout. Satisfaction garantie.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-blue-900 text-white pt-16 pb-8">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8 border-b border-blue-800 pb-12">
            <div>
                <img src="../img/1.png" class="h-28 mb-6 brightness-0 invert">
                <p class="text-sm text-blue-200">Facilitons l'accès aux services pour tous.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Services</h4>
                <ul class="text-sm text-blue-200 space-y-2">
                    <li><a href="#" class="hover:text-white">Plomberie</a></li>
                    <li><a href="#" class="hover:text-white">Électricité</a></li>
                    <li><a href="#" class="hover:text-white">Climatisation</a></li>
                    <li><a href="#" class="hover:text-white">Peinture</a></li>
                    <li><a href="#" class="hover:text-white">Mécanique auto</a></li>
                    <li><a href="#" class="hover:text-white">Mensuiserie</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Support</h4>
                <ul class="text-sm text-blue-200 space-y-2">
                    <li><a href="#" class="hover:text-white">Aide</a></li>
                    <li><a href="#" class="hover:text-white">Comment ça marche</a></li>
                    <li><a href="#" class="hover:text-white">Contactez-nous</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Réseaux Sociaux</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-xl hover:text-orange-500 transition"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-xl hover:text-orange-500 transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-xl hover:text-orange-500 transition"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4 pt-8 text-center text-sm text-blue-300">
            &copy; 2026 khedema_time+pay - Facilitons l'accès aux services pour tous
        </div>
    </footer>

</body>
</html>