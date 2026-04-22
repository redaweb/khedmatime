<?php
include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Centre d'Aide - Khedema+pay</title>
    <style>
        .faq-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <section class="faq-gradient py-16 text-white text-center">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-4">Comment pouvons-nous vous aider ?</h1>
            <div class="max-w-2xl mx-auto relative">
                <input type="text" placeholder="Rechercher une solution (ex: paiement, compte...)" 
                       class="w-full px-6 py-4 rounded-full text-gray-900 shadow-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                <button class="absolute right-2 top-2 bg-orange-500 hover:bg-orange-600 px-6 py-2 rounded-full transition">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </section>

    <main class="container mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <aside class="w-full lg:w-1/4">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-6">
                    <h3 class="font-bold text-blue-900 mb-6 uppercase text-xs tracking-widest">Catégories</h3>
                    <nav class="space-y-2">
                        <a href="#general" class="flex items-center p-3 text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-xl transition font-medium group">
                            <i class="fas fa-info-circle mr-3 text-blue-400 group-hover:text-blue-700"></i> Général
                        </a>
                        <a href="#client" class="flex items-center p-3 text-gray-600 hover:bg-orange-50 hover:text-orange-600 rounded-xl transition font-medium group">
                            <i class="fas fa-user mr-3 text-orange-300 group-hover:text-orange-600"></i> Espace Client
                        </a>
                        <a href="#artisan" class="flex items-center p-3 text-gray-600 hover:bg-green-50 hover:text-green-600 rounded-xl transition font-medium group">
                            <i class="fas fa-tools mr-3 text-green-400 group-hover:text-green-600"></i> Espace Artisan
                        </a>
                        <a href="#contact" class="flex items-center p-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-xl transition font-medium group">
                            <i class="fas fa-headset mr-3 text-red-400 group-hover:text-red-600"></i> Contact Support
                        </a>
                    </nav>
                </div>
            </aside>

            <div class="w-full lg:w-3/4 space-y-12">
                
                <section id="general">
                    <h2 class="text-2xl font-bold text-blue-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center mr-3 text-sm">
                            <i class="fas fa-star"></i>
                        </span>
                        Questions Fréquentes
                    </h2>
                    <div class="space-y-4">
                        <details class="group bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                            <summary class="flex justify-between items-center p-5 cursor-pointer font-bold text-gray-800 hover:bg-gray-50 transition">
                                Est-ce que le service est gratuit ?
                                <span class="text-blue-500 group-open:rotate-180 transition-transform"><i class="fas fa-chevron-down"></i></span>
                            </summary>
                            <div class="p-5 border-t border-gray-50 text-gray-600 leading-relaxed">
                                Oui, l'inscription et la mise en relation de base sont gratuites. Nous proposons des options "Premium" pour les artisans souhaitant mettre en avant leurs services.
                            </div>
                        </details>

                        <details class="group bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                            <summary class="flex justify-between items-center p-5 cursor-pointer font-bold text-gray-800 hover:bg-gray-50 transition">
                                Comment réinitialiser mon mot de passe ?
                                <span class="text-blue-500 group-open:rotate-180 transition-transform"><i class="fas fa-chevron-down"></i></span>
                            </summary>
                            <div class="p-5 border-t border-gray-50 text-gray-600">
                                Cliquez sur "Se connecter", puis sur "Mot de passe oublié". Un lien de réinitialisation vous sera envoyé par email.
                            </div>
                        </details>
                    </div>
                </section>

                <section id="artisan">
                    <h2 class="text-2xl font-bold text-blue-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-green-100 text-green-700 rounded-lg flex items-center justify-center mr-3 text-sm">
                            <i class="fas fa-hammer"></i>
                        </span>
                        Pour les Artisans
                    </h2>
                    <div class="space-y-4">
                        <details class="group bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                            <summary class="flex justify-between items-center p-5 cursor-pointer font-bold text-gray-800 hover:bg-gray-50 transition">
                                Comment recevoir plus de demandes ?
                                <span class="text-blue-500 group-open:rotate-180 transition-transform"><i class="fas fa-chevron-down"></i></span>
                            </summary>
                            <div class="p-5 border-t border-gray-50 text-gray-600">
                                Complétez votre profil avec une photo professionnelle, listez précisément vos services et demandez à vos clients de laisser des évaluations positives.
                            </div>
                        </details>
                    </div>
                </section>

                <section id="contact" class="bg-orange-500 rounded-3xl p-8 text-white flex flex-col md:flex-row items-center justify-between shadow-xl">
                    <div class="mb-6 md:mb-0">
                        <h2 class="text-2xl font-bold mb-2">Vous ne trouvez pas de réponse ?</h2>
                        <p class="text-orange-100">Notre équipe de support est disponible 7j/7 pour vous accompagner.</p>
                    </div>
                    <a href="mailto:support@khedemapay.dz" class="bg-white text-orange-600 px-8 py-3 rounded-full font-bold hover:bg-orange-50 transition shadow-md">
                        Contacter le support
                    </a>
                </section>

            </div>
        </div>
    </main>

<?php
include '../includes/footer.php';