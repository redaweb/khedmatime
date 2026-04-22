<?php include '../model/evaluations.php'; ?>

<div class="max-w-7xl mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-8 flex items-center">
        <i class="fas fa-star text-yellow-500 mr-3"></i> Évaluations des services
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($evaluations as $eval): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300">
                <div class="relative h-32 bg-gray-200">
                    <img src="../uploads/services/<?php echo $eval['service_image']; ?>" 
                         alt="Service" class="w-full h-full object-cover">
                    <div class="absolute top-2 right-2 bg-white/90 backdrop-blur px-2 py-1 rounded-lg text-xs font-bold text-blue-700">
                        <?php echo htmlspecialchars($eval['categorie']); ?>
                    </div>
                </div>

                <div class="p-5">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="font-bold text-gray-900 truncate w-2/3">
                            <?php echo htmlspecialchars($eval['service_nom']); ?>
                        </h3>
                        <div class="flex items-center bg-yellow-50 px-2 py-1 rounded-md">
                            <span class="text-yellow-600 font-bold mr-1"><?php echo $eval['note']; ?></span>
                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                        </div>
                    </div>

                    <hr class="border-gray-50 mb-4">

                    <div class="flex items-center">
                        <img src="../uploads/profiles/<?php echo $eval['client_photo'] ?: 'default.png'; ?>" 
                             class="w-10 h-10 rounded-full border-2 border-white shadow-sm object-cover" alt="Client">
                        <div class="ml-3">
                            <p class="text-sm font-bold text-gray-800">
                                <?php echo htmlspecialchars($eval['client_prenom'] . ' ' . $eval['client_nom']); ?>
                            </p>
                            <p class="text-[11px] text-gray-500 flex items-center">
                                <i class="fas fa-map-marker-alt mr-1"></i> <?php echo htmlspecialchars($eval['wilaya']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($evaluations)): ?>
        <div class="text-center py-20">
            <i class="fas fa-comment-slash text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 font-medium">Aucune évaluation pour le moment.</p>
        </div>
    <?php endif; ?>
</div>