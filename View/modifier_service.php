<?php
include '../includes/auth_middleware.php';
include '../config/db.php'; 

requireLogin('login.php');

if (!isset($_GET['id'])) {
    header("Location: dashboard_prestataire.php");
    exit();
}

$id_service = $_GET['id'];
$user_id = currentUserId();

$stmt = $pdo->prepare("SELECT * FROM service WHERE id_service = ? AND id_prestataire = ?");
$stmt->execute([$id_service, $user_id]);
$service = $stmt->fetch();

if (!$service) {
    die("Service non trouvé ou accès non autorisé.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $type_service = $_POST['type_service'];

    $update = $pdo->prepare("UPDATE service SET nom = ?, description = ?, type_service = ? WHERE id_service = ?");
    if ($update->execute([$nom, $description, $type_service, $id_service])) {
        header("Location: dashboard_prestataire.php?msg=updated");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Modifier Service</title>
</head>
<body class="bg-gray-50 p-10">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-sm border">
        <h2 class="text-2xl font-bold mb-6 italic text-blue-900">Modifier mon service</h2>
        
        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-bold mb-1">Nom du service</label>
                <input type="text" name="nom" value="<?php echo htmlspecialchars($service['nom']); ?>" class="w-full p-3 border rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Description</label>
                <textarea name="description" class="w-full p-3 border rounded-lg"><?php echo htmlspecialchars($service['description']); ?></textarea>
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Type de service</label>
                <select name="type_service" class="w-full p-3 border rounded-lg">
                    <option value="argent" <?php if($service['type_service'] == 'argent') echo 'selected'; ?>>Argent</option>
                    <option value="echange" <?php if($service['type_service'] == 'echange') echo 'selected'; ?>>Échange</option>
                </select>
            </div>
            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-blue-900 text-white px-6 py-2 rounded-lg font-bold">Enregistrer les modifications</button>
                <a href="dashboard_prestataire.php" class="bg-gray-200 px-6 py-2 rounded-lg font-bold">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>