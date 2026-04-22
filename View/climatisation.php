<?php
session_start();
include '../model/get_services_climatisation.php'; 
?>

    <div class="container mx-auto px-4">
        
        <a href="index.php" class="inline-flex items-center text-blue-700 hover:text-blue-900 font-semibold mb-6 transition">
            <i class="fas fa-arrow-left mr-2"></i> Retour aux catégories
        </a>

        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl font-extrabold text-gray-900 flex items-center justify-center md:justify-start">
                <i class="fas fa-snowflake text-orange-500 mr-3"></i> Artisans en Climatisation
            </h1>
            <p class="text-gray-500 mt-2">
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-bold">
                    <?php echo count($services); ?> spécialistes disponibles
                </span>
            </p>
        </div>

        <?php if(count($services) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($services as $artisan): ?>
                    <?php
                        $link = isset($_SESSION['user_id']) ? "artisan.php?id=" . $artisan['id_service'] : "../view/login.php";
                    ?>
                    
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1 group">
                        
                        <div class="h-24 bg-gradient-to-r from-blue-900 to-blue-700"></div>

                        <div class="p-6 -mt-12">
                            <div class="flex items-end justify-between mb-4">
                                <img src="../<?php echo $artisan['image'] ?: 'https://i.pravatar.cc/150?u=' . $artisan['id_service']; ?>" 
                                     class="w-20 h-20 rounded-2xl border-4 border-white object-cover shadow-md bg-white">
                                
                                <span class="bg-gray-100 text-gray-600 text-xs font-bold px-3 py-1 rounded-lg">
                                    <i class="fas fa-map-marker-alt text-red-500 mr-1"></i> <?php echo htmlspecialchars($artisan['wilaya']); ?>
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition">
                                <?php echo htmlspecialchars($artisan['prenom_utilisateur'] . " " . $artisan['nom_utilisateur']); ?>
                            </h3>
                            <p class="text-orange-500 font-semibold text-sm mb-3"><?php echo htmlspecialchars($artisan['service_nom']); ?></p>
                            
                            <p class="text-gray-500 text-sm line-clamp-2 mb-4 h-10">
                                <?php echo htmlspecialchars($artisan['description']); ?>
                            </p>

                            <div class="space-y-2 border-t border-gray-50 pt-4">
                                <div class="flex items-center text-xs text-gray-600">
                                    <i class="fas fa-phone-alt w-5 text-blue-700"></i>
                                    <span class="font-medium"><?php echo htmlspecialchars($artisan['telephone']); ?></span>
                                </div>
                                <div class="flex items-center text-xs text-gray-600">
                                    <i class="fas fa-sync-alt w-5 text-blue-700"></i>
                                    <span class="font-medium">Mode : <?php echo htmlspecialchars($artisan['type_service']); ?></span>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center justify-between">
                                <?php if(stripos($artisan['type_service'], 'echange') !== false): ?>
                                    <span class="bg-green-100 text-green-700 text-[10px] font-extrabold uppercase px-3 py-1 rounded-full border border-green-200">
                                        Accepte l'échange
                                    </span>
                                <?php else: ?>
                                    <span class="text-blue-900 font-bold text-lg">Paiement Argent</span>
                                <?php endif; ?>

                                <a href="<?php echo $link; ?>" class="bg-blue-900 hover:bg-orange-500 text-white p-3 rounded-xl transition duration-300">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-3xl p-20 text-center shadow-sm border border-gray-100">
                <div class="text-gray-200 mb-4">
                    <i class="fas fa-wind text-6xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Aucun technicien trouvé</h3>
                <p class="text-gray-500">Besoin d'un coup de frais ? Revenez bientôt !</p>
                <a href="service.php" class="mt-6 inline-block bg-orange-500 text-white px-8 py-3 rounded-full font-bold">Proposer mes services</a>
            </div>
        <?php endif; ?>
    </div>

<?php include '../includes/footer.php'; ?>