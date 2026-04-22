<?php include '../model/demandes_prestataire.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Demandes Reçues - Khedema+pay</title>
</head>

<body class="bg-gray-50 font-sans antialiased">

    <main class="container mx-auto px-6 py-10">

        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Demandes Reçues</h1>
                <p class="text-gray-500 mt-1">Retrouvez les clients qui souhaitent solliciter vos services.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <?php if(count($demandes) > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-900 text-white">
                            <th class="px-6 py-4 text-sm font-semibold uppercase">Client</th>
                            <th class="px-6 py-4 text-sm font-semibold uppercase">Service Demandé</th>
                            <th class="px-6 py-4 text-sm font-semibold uppercase">Localisation</th>
                            <th class="px-6 py-4 text-sm font-semibold uppercase">Contact</th>
                            <th class="px-6 py-4 text-sm font-semibold uppercase text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach($demandes as $demande): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img class="h-10 w-10 rounded-full object-cover mr-3 border border-gray-200"
                                        src="../uploads/profiles/<?php echo $demande['photo'] ?: 'default_user.png'; ?>"
                                        alt="">
                                    <div class="font-bold text-gray-900">
                                        <?php echo htmlspecialchars($demande['client_nom'] . ' ' . $demande['client_prenom']); ?>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <?php echo htmlspecialchars($demande['service_nom']); ?></div>
                                <div class="text-xs text-blue-600 font-semibold uppercase">
                                    <?php echo htmlspecialchars($demande['categorie']); ?></div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt text-red-400 mr-1"></i>
                                <?php echo htmlspecialchars($demande['wilaya']); ?>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono">
                                <i class="fas fa-phone-alt text-green-500 mr-1"></i>
                                <?php echo htmlspecialchars($demande['telephone']); ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center space-x-2">
                                    <?php 
        $statut = $demande['statut']; 
        ?>

                                    <?php if ($statut === 'en attente' || $statut === ''): ?>
                                    <a href="../model/traiter_demande.php?id=<?php echo $demande['id_demande']; ?>&action=accepter"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm flex items-center">
                                        <i class="fas fa-check mr-1"></i> Accepter
                                    </a>

                                    <a href="../model/traiter_demande.php?id=<?php echo $demande['id_demande']; ?>&action=refuser"
                                        onclick="return confirm('Refuser cette demande ?')"
                                        class="bg-red-50 hover:bg-red-500 hover:text-white text-red-500 px-3 py-1.5 rounded-lg text-xs font-bold transition border border-red-100 flex items-center">
                                        <i class="fas fa-times mr-1"></i> Refuser
                                    </a>

                                    <?php elseif ($statut === 'accepte' || $statut === 'accepté'): ?>
                                    <div class="flex flex-col items-center">
                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase mb-1">
                                            <i class="fas fa-check-circle mr-1"></i> Acceptée
                                        </span>
                                        <a href="../model/traiter_demande.php?id=<?php echo $demande['id_demande']; ?>&action=annuler"
                                            onclick="return confirm('Voulez-vous annuler l\'acceptation et remettre en attente ?')"
                                            class="text-gray-400 hover:text-red-600 transition text-[10px] font-bold underline">
                                            Annuler l'acceptation
                                        </a>
                                    </div>

                                    <?php elseif ($statut === 'refuse' || $statut === 'refusé'): ?>
                                    <span
                                        class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase">
                                        <i class="fas fa-ban mr-1"></i> Refusée
                                    </span>
                                    <?php endif; ?>

                                    <a href="details_demande.php?id=<?php echo $demande['id_demande']; ?>"
                                        class="ml-2 text-blue-400 hover:text-blue-700 transition" title="Voir détails">
                                        <i class="fas fa-eye"></i>
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
                    <i class="fas fa-inbox text-6xl"></i>
                </div>
                <p class="text-gray-500 text-lg">Aucune demande reçue pour le moment.</p>
            </div>
            <?php endif; ?>
        </div>

    </main>

    <footer class="mt-20 py-6 border-t border-gray-200 text-center text-gray-400 text-sm">
        &copy; 2024 Khedema+pay - Espace Artisan
    </footer>

</body>

</html>