<?php
include '../includes/auth_middleware.php';
include '../config/db.php';
include '../includes/header.php';

// 1. Vérification de la session
requireLogin('login.php');

$id_user = currentUserId();
$message = "";

// 2. Traitement de la mise à jour
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $adresse = htmlspecialchars($_POST['adress']);
    $wilaya = htmlspecialchars($_POST['wilaya']);
    
    // Gestion de la photo de profil
    $photo_name = $_POST['current_photo']; // Garder l'ancienne par défaut
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $upload_dir = "../uploads/profiles/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photo_name = "user_" . $id_user . "_" . time() . "." . $ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir . $photo_name);
    }

    $update = $pdo->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, telephone = ?, adress = ?, wilaya = ?, photo = ? WHERE id_utilisateur = ?");
    if ($update->execute([$nom, $prenom, $telephone, $adresse, $wilaya, $photo_name, $id_user])) {
        $_SESSION['nom'] = $nom; // Mettre à jour la session pour la navbar
        $_SESSION['prenom'] = $prenom;
        $message = "success";
    } else {
        $message = "error";
    }
}

// 3. Récupérer les données actuelles de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
$stmt->execute([$id_user]);
$user = $stmt->fetch();
?>

    <div class="container mx-auto px-4 max-w-3xl">
        
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="h-32 bg-blue-900 relative">
                <div class="absolute -bottom-12 left-8">
                    <div class="relative group">
                        <img id="avatar-preview" src="<?php echo $user['photo'] ? '../uploads/profiles/'.$user['photo'] : 'https://ui-avatars.com/api/?name='.$user['prenom'].'+'.$user['nom'].'&background=random'; ?>" 
                             class="w-32 h-32 rounded-3xl border-4 border-white object-cover shadow-lg bg-white">
                    </div>
                </div>
            </div>

            <div class="pt-16 p-8">
                <div class="mb-8">
                    <h1 class="text-2xl font-extrabold text-gray-900">Paramètres du profil</h1>
                    <p class="text-gray-500 text-sm">Gérez vos informations personnelles et votre visibilité.</p>
                </div>

                <?php if($message == "success"): ?>
                    <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-100 rounded-2xl flex items-center">
                        <i class="fas fa-check-circle mr-2"></i> Profil mis à jour avec succès !
                    </div>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <input type="hidden" name="current_photo" value="<?php echo $user['photo']; ?>">
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-blue-900">Changer la photo de profil</label>
                        <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-blue-900">Nom</label>
                            <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-900 outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-blue-900">Prénom</label>
                            <input type="text" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-900 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-blue-900">Téléphone</label>
                            <input type="text" name="telephone" value="<?php echo htmlspecialchars($user['telephone']); ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-900 outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-blue-900">Wilaya</label>
                            <select name="wilaya" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-900 outline-none">
                                <option value="Alger" <?php if($user['wilaya'] == 'Alger') echo 'selected'; ?>>Alger</option>
                                <option value="Oran" <?php if($user['wilaya'] == 'Oran') echo 'selected'; ?>>Oran</option>
                                <option value="Constantine" <?php if($user['wilaya'] == 'Constantine') echo 'selected'; ?>>Constantine</option>
                                </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-blue-900">Adresse exacte</label>
                        <input type="text" name="adress" value="<?php echo htmlspecialchars($user['adress']); ?>" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-900 outline-none" placeholder="Rue, quartier...">
                    </div>

                    <div class="pt-4 flex gap-4">
                        <button type="submit" class="bg-blue-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg">Enregistrer les modifications</button>
                        <a href="index.php" class="bg-gray-100 text-gray-600 px-8 py-3 rounded-xl font-bold hover:bg-gray-200 transition text-center">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include '../includes/footer.php'; ?>