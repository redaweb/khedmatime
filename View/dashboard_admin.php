<?php
session_start();
$error = $_SESSION['error'] ?? null;
$success = $_SESSION['success'] ?? null;
unset($_SESSION['error'], $_SESSION['success']);
include '../model/dashboard_admin.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard Admin - Khedema+pay</title>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <?php include '../includes/navbar.php'; ?>
    <main class="max-w-7xl mx-auto px-6 py-8 space-y-8">
        <section>
            <h1 class="text-3xl font-extrabold text-blue-900">Administration des comptes</h1>
            <p class="text-gray-500 mt-1">Valider les prestataires et superviser les utilisateurs.</p>
        </section>

        <?php if ($error): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 text-sm p-3 rounded-md">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm p-3 rounded-md">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <section class="bg-white border rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-bold text-gray-900">Validation des prestataires</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-3">Prestataire</th>
                            <th class="px-6 py-3">Téléphone</th>
                            <th class="px-6 py-3">Wilaya</th>
                            <th class="px-6 py-3">Diplôme</th>
                            <th class="px-6 py-3">Statut</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($prestataires as $prestataire): ?>
                            <tr>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    <?php echo htmlspecialchars($prestataire['prenom'] . ' ' . $prestataire['nom']); ?>
                                </td>
                                <td class="px-6 py-4 text-gray-600"><?php echo htmlspecialchars($prestataire['telephone']); ?></td>
                                <td class="px-6 py-4 text-gray-600"><?php echo htmlspecialchars($prestataire['wilaya']); ?></td>
                                <td class="px-6 py-4">
                                    <?php if (!empty($prestataire['diplome_path'])): ?>
                                        <a href="../<?php echo htmlspecialchars($prestataire['diplome_path']); ?>" class="text-blue-700 underline" target="_blank">Voir diplôme</a>
                                    <?php else: ?>
                                        <span class="text-gray-400">Non fourni</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-xs font-bold
                                        <?php echo $prestataire['statut'] === 'accepte'
                                            ? 'bg-green-100 text-green-700'
                                            : ($prestataire['statut'] === 'refuse' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700'); ?>">
                                        <?php echo htmlspecialchars($prestataire['statut']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if ($prestataire['statut'] === 'en_attente'): ?>
                                        <div class="flex gap-2">
                                            <form action="../model/valider_prestataire.php" method="POST">
                                                <input type="hidden" name="id_prestataire" value="<?php echo (int) $prestataire['id_prestataire']; ?>">
                                                <input type="hidden" name="action" value="accepte">
                                                <button type="submit" class="px-3 py-2 rounded-lg bg-green-600 text-white text-xs font-bold hover:bg-green-700">Accepter</button>
                                            </form>
                                            <form action="../model/valider_prestataire.php" method="POST">
                                                <input type="hidden" name="id_prestataire" value="<?php echo (int) $prestataire['id_prestataire']; ?>">
                                                <input type="hidden" name="action" value="refuse">
                                                <button type="submit" class="px-3 py-2 rounded-lg bg-red-600 text-white text-xs font-bold hover:bg-red-700">Refuser</button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-400 text-sm">Traité</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="bg-white border rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-bold text-gray-900">Tous les comptes</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Nom complet</th>
                            <th class="px-6 py-3">Téléphone</th>
                            <th class="px-6 py-3">Rôle</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="px-6 py-4 text-gray-600"><?php echo (int) $user['id_utilisateur']; ?></td>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    <?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?>
                                </td>
                                <td class="px-6 py-4 text-gray-600"><?php echo htmlspecialchars($user['telephone']); ?></td>
                                <td class="px-6 py-4 text-gray-600"><?php echo htmlspecialchars($user['role'] ?? 'client'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
