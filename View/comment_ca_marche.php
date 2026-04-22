<?php include '../model/comment_ca_marche.php'; ?>

<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <section class="relative bg-white py-10 border-b border-gray-100">
        <div class="container mx-auto px-10 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-6">
                Le service entre particuliers, <span class="text-orange-500">simplement.</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Khedema+pay connecte les talents locaux avec ceux qui en ont besoin. Découvrez comment notre plateforme facilite vos échanges de services.
            </p>
        </div>
    </section>

    <section class="py-10">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                
                <div class="relative group">
                    <div class="w-20 h-20 bg-blue-50 text-blue-700 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl shadow-sm group-hover:bg-blue-700 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-blue-900">1. Recherchez</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Explorez nos catégories et trouvez l'artisan ou le prestataire qui correspond parfaitement à votre besoin (Plomberie, Informatique, Jardinage...).
                    </p>
                    <div class="hidden md:block absolute top-10 -right-6 text-gray-200 text-4xl">
                        <i class="fas fa-long-arrow-alt-right"></i>
                    </div>
                </div>

                <div class="relative group">
                    <div class="w-20 h-20 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl shadow-sm group-hover:bg-orange-500 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-blue-900">2. Envoyez une demande</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Détaillez votre besoin et envoyez une demande en un clic. Le prestataire recevra une notification immédiate pour vous répondre.
                    </p>
                    <div class="hidden md:block absolute top-10 -right-6 text-gray-200 text-4xl">
                        <i class="fas fa-long-arrow-alt-right"></i>
                    </div>
                </div>

                <div class="group">
                    <div class="w-20 h-20 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl shadow-sm group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-blue-900">3. Réalisation & Avis</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Une fois le service effectué, validez la prestation et laissez un avis pour aider la communauté à choisir les meilleurs profils.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-blue-900 py-16 text-white overflow-hidden relative">
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2 mb-10 md:mb-0">
                    <h2 class="text-3xl font-bold mb-6">Pourquoi utiliser Khedema+pay ?</h2>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-orange-500 mr-3 text-xl"></i>
                            <span>Artisans qualifiés et vérifiés</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-orange-500 mr-3 text-xl"></i>
                            <span>Messagerie directe et simplifiée</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-orange-500 mr-3 text-xl"></i>
                            <span>Gestion transparente des demandes</span>
                        </li>
                    </ul>
                </div>
                <div class="w-full md:w-1/2 flex justify-center">
                    <div class="p-8 bg-white/10 backdrop-blur-md rounded-3xl border border-white/20">
                        <i class="fas fa-shield-alt text-7xl text-orange-500"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-64 h-64 bg-orange-500/20 rounded-full blur-3xl"></div>
    </section>
<?php
include '../includes/footer.php';