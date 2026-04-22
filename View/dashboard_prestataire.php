<?php
include '../model/dashboard_prestataire.php';
?>
<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Dashboard Prestataire - Khedema+pay</title>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <main class="container mx-auto px-6 py-10">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Gestion Services</h1>
                <p class="text-gray-500 mt-1">Gérez vos services et vos compétences en un clic.</p>
            </div>
            <a href="service.php" class="inline-flex items-center bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 shadow-md transform active:scale-95">
                <i class="fas fa-plus mr-2"></i> Ajouter un service
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <?php if(count($services) > 0): ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-blue-900 text-white">
                                <th class="px-6 py-4 text-sm font-semibold uppercase">Nom du Service</th>
                                <th class="px-6 py-4 text-sm font-semibold uppercase">Type</th>
                                <th class="px-6 py-4 text-sm font-semibold uppercase">Catégorie</th>
                                <th class="px-6 py-4 text-sm font-semibold uppercase">Description</th>
                                <th class="px-6 py-4 text-sm font-semibold uppercase text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach($services as $service): ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900"><?php echo htmlspecialchars($service['nom']); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase">
                                            <?php echo htmlspecialchars($service['type_service']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <?php echo htmlspecialchars($service['categorie']); ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 italic max-w-xs truncate">
                                        <?php echo htmlspecialchars($service['description']); ?>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center space-x-3">
                                            <a href="modifier_service.php?id=<?php echo $service['id_service']; ?>" 
                                               class="text-blue-600 hover:text-blue-800 transition p-2 hover:bg-blue-50 rounded-full" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="supprimer_service.php?id=<?php echo $service['id_service']; ?>" 
                                               onclick="return confirm('Voulez-vous vraiment supprimer ce service ?');"
                                               class="text-red-500 hover:text-red-700 transition p-2 hover:bg-red-50 rounded-full" title="Supprimer">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="py-20 text-center">
                    <div class="text-gray-300 mb-4">
                        <i class="fas fa-tools text-6xl"></i>
                    </div>
                    <p class="text-gray-500 text-lg">Vous n'avez encore aucun service répertorié.</p>
                    <a href="service.php" class="text-blue-700 font-bold hover:underline mt-2 inline-block">Commencez par en ajouter un !</a>
                </div>
            <?php endif; ?>
        </div>

    </main>

    <footer class="mt-20 py-6 border-t border-gray-200 text-center text-gray-400 text-sm">
        &copy; 2024 Khedema+pay - Espace Artisan
    </footer>

</body>
</html>