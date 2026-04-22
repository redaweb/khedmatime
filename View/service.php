<?php
include '../includes/auth_middleware.php';
include '../config/db.php'; 
include '../includes/header.php';

requireLogin('../view/login.php');

$message = "";
$messageType = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nom = htmlspecialchars($_POST['nom']);
    $type_service = htmlspecialchars($_POST['type_paiement']);
    $categorie = htmlspecialchars($_POST['categorie']);
    $description = htmlspecialchars($_POST['description']);
    $id_prestataire = currentUserId(); 

    $image_name = "";
    if (isset($_FILES['galerie']) && $_FILES['galerie']['error'][0] == 0) {
        $upload_dir = "../uploads/services/";
        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $extension = pathinfo($_FILES['galerie']['name'][0], PATHINFO_EXTENSION);
        $file_new_name = "service_" . time() . "_" . rand(1000, 9999) . "." . $extension;
        $target_file = $upload_dir . $file_new_name;

        if (move_uploaded_file($_FILES['galerie']['tmp_name'][0], $target_file)) {
            $image_name = "uploads/services/" . $file_new_name;
        }
    }

    try {
        $sql = "INSERT INTO service (nom, image, description, type_service, categorie, id_prestataire) 
                VALUES (:nom, :image, :description, :type_service, :categorie, :id_prestataire)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':image' => $image_name,
            ':description' => $description,
            ':type_service' => $type_service,
            ':categorie' => $categorie,
            ':id_prestataire' => $id_prestataire
        ]);

        $message = "Votre service a été ajouté avec succès !";
        $messageType = "success";
    } catch (PDOException $e) {
        $message = "Erreur lors de l'ajout : " . $e->getMessage();
        $messageType = "error";
    }
}
?>

<section class="min-h-screen flex items-center justify-center py-12 px-4" style="background-color: rgb(249 250 251);">

    <div class="bg-white w-full max-w-2xl p-8 md:p-10 rounded-3xl shadow-2xl border border-gray-100">
        
        <?php if ($message !== ""): ?>
            <div class="mb-6 p-4 rounded-xl flex items-center <?php echo ($messageType == 'success') ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200'; ?>">
                <i class="fas <?php echo ($messageType == 'success') ? 'fa-check-circle' : 'fa-exclamation-triangle'; ?> mr-2"></i>
                <?php echo $message; ?>
                <?php if($messageType == 'success'): ?>
                    <script>setTimeout(() => { window.location.href = "dashboard_prestataire.php"; }, 2000);</script>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 text-orange-600 rounded-full mb-4">
                <i class="fas fa-tools text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-blue-900">Ajouter un service</h1>
            <p class="text-gray-500 mt-2 font-medium">Configurez votre mode de travail et votre spécialité.</p>
        </div>

        <form class="space-y-6" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-blue-900 ml-1">Nom du service</label>
                    <input type="text" name="nom" required placeholder="Ex: Réparation fuite eau"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none transition bg-gray-50/50">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-blue-900 ml-1">Type de service</label>
                    <div class="relative">
                        <select name="type_paiement" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none transition bg-gray-50/50 appearance-none cursor-pointer text-gray-600">
                            <option value="" disabled selected>Choisir le mode</option>
                            <option value="Paiement">Paiement d'argent</option>
                            <option value="Échange">Échange de services (Troc)</option>
                            <option value="Les deux">Les deux (Argent ou Échange)</option>
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-bold text-blue-900 ml-1">Votre Métier</label>
                <div class="relative">
                    <select name="categorie" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none transition bg-gray-50/50 appearance-none cursor-pointer text-gray-600">
                        <option value="" disabled selected>Sélectionnez votre métier</option>
                        <option value="Plombier">Plombier</option>
                        <option value="Menuiserie">Menuiserie</option>
                        <option value="Mécanique Auto">Mécanique Auto</option>
                        <option value="Électricité">Électricité</option>
                        <option value="Climatisation">Climatisation</option>
                        <option value="Peinture">Peinture</option>
                    </select>
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-bold text-blue-900 ml-1">Description</label>
                <textarea name="description" rows="4" maxlength="250" placeholder="Décrivez vos compétences..."
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none resize-none transition bg-gray-50/50"></textarea>
                <p class="text-[10px] text-right text-gray-400 font-medium uppercase tracking-wider">Max 250 caractères</p>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-bold text-blue-900 ml-1">Photo de présentation</label>
                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer hover:bg-orange-50 hover:border-orange-300 transition-all group bg-gray-50/30">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <i class="fas fa-cloud-upload-alt text-gray-400 group-hover:text-orange-500 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-500 group-hover:text-orange-600">Cliquez pour ajouter une photo</p>
                    </div>
                    <input type="file" name="galerie[]" accept="image/*" onchange="previewImages(event)" class="hidden">
                </label>
            </div>

            <div id="preview" class="grid grid-cols-4 gap-4"></div>

            <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-4 rounded-xl font-bold text-lg transition duration-300 shadow-lg shadow-orange-500/20 transform active:scale-[0.98]">
                Créer le service
            </button>

        </form>
    </div>

</section>

<script>
function previewImages(event) {
    const preview = document.getElementById('preview');
    preview.innerHTML = '';
    const files = event.target.files;
    if (files) {
        [].forEach.call(files, function(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = "h-16 w-16 rounded-lg overflow-hidden border border-gray-100 shadow-sm";
                div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                preview.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
}
</script>

<?php include '../includes/footer.php'; ?>