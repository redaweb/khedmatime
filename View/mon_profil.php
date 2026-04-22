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
                            <option <?php if($user['wilaya'] == '') echo 'selected'; ?> value="">Sélectionner</option>
                                <option <?php if($user['wilaya'] == '01') echo 'selected'; ?> value="01">01 - Adrar</option>
                                <option <?php if($user['wilaya'] == '02') echo 'selected'; ?> value="02">02 - Chlef</option>
                                <option <?php if($user['wilaya'] == '03') echo 'selected'; ?> value="03">03 - Laghouat</option>
                                <option <?php if($user['wilaya'] == '04') echo 'selected'; ?> value="04">04 - Oum El Bouaghi</option>
                                <option <?php if($user['wilaya'] == '05') echo 'selected'; ?> value="05">05 - Batna</option>
                                <option <?php if($user['wilaya'] == '06') echo 'selected'; ?> value="06">06 - Béjaïa</option>
                                <option <?php if($user['wilaya'] == '07') echo 'selected'; ?> value="07">07 - Biskra</option>
                                <option <?php if($user['wilaya'] == '08') echo 'selected'; ?> value="08">08 - Béchar</option>
                                <option <?php if($user['wilaya'] == '09') echo 'selected'; ?> value="09">09 - Blida</option>
                                <option <?php if($user['wilaya'] == '10') echo 'selected'; ?> value="10">10 - Bouira</option>
                                <option <?php if($user['wilaya'] == '11') echo 'selected'; ?> value="11">11 - Tamanrasset</option>
                                <option <?php if($user['wilaya'] == '12') echo 'selected'; ?> value="12">12 - Tébessa</option>
                                <option <?php if($user['wilaya'] == '13') echo 'selected'; ?> value="13">13 - Tlemcen</option>
                                <option <?php if($user['wilaya'] == '14') echo 'selected'; ?> value="14">14 - Tiaret</option>
                                <option <?php if($user['wilaya'] == '15') echo 'selected'; ?> value="15">15 - Tizi Ouzou</option>
                                <option <?php if($user['wilaya'] == '16') echo 'selected'; ?> value="16">16 - Alger</option>
                                <option <?php if($user['wilaya'] == '17') echo 'selected'; ?> value="17">17 - Djelfa</option>
                                <option <?php if($user['wilaya'] == '18') echo 'selected'; ?> value="18">18 - Jijel</option>
                                <option <?php if($user['wilaya'] == '19') echo 'selected'; ?> value="19">19 - Sétif</option>
                                <option <?php if($user['wilaya'] == '20') echo 'selected'; ?> value="20">20 - Saïda</option>
                                <option <?php if($user['wilaya'] == '21') echo 'selected'; ?> value="21">21 - Skikda</option>
                                <option <?php if($user['wilaya'] == '22') echo 'selected'; ?> value="22">22 - Sidi Bel Abbès</option>
                                <option <?php if($user['wilaya'] == '23') echo 'selected'; ?> value="23">23 - Annaba</option>
                                <option <?php if($user['wilaya'] == '24') echo 'selected'; ?> value="24">24 - Guelma</option>
                                <option <?php if($user['wilaya'] == '25') echo 'selected'; ?> value="25">25 - Constantine</option>
                                <option <?php if($user['wilaya'] == '26') echo 'selected'; ?> value="26">26 - Médéa</option>
                                <option <?php if($user['wilaya'] == '27') echo 'selected'; ?> value="27">27 - Mostaganem</option>
                                <option <?php if($user['wilaya'] == '28') echo 'selected'; ?> value="28">28 - M'Sila</option>
                                <option <?php if($user['wilaya'] == '29') echo 'selected'; ?> value="29">29 - Mascara</option>
                                <option <?php if($user['wilaya'] == '30') echo 'selected'; ?> value="30">30 - Ouargla</option>
                                <option <?php if($user['wilaya'] == '31') echo 'selected'; ?> value="31">31 - Oran</option>
                                <option <?php if($user['wilaya'] == '32') echo 'selected'; ?> value="32">32 - El Bayadh</option>
                                <option <?php if($user['wilaya'] == '33') echo 'selected'; ?> value="33">33 - Illizi</option>
                                <option <?php if($user['wilaya'] == '34') echo 'selected'; ?> value="34">34 - Bordj Bou Arreridj</option>
                                <option <?php if($user['wilaya'] == '35') echo 'selected'; ?> value="35">35 - Boumerdès</option>
                                <option <?php if($user['wilaya'] == '36') echo 'selected'; ?> value="36">36 - El Tarf</option>
                                <option <?php if($user['wilaya'] == '37') echo 'selected'; ?> value="37">37 - Tindouf</option>
                                <option <?php if($user['wilaya'] == '38') echo 'selected'; ?> value="38">38 - Tissemsilt</option>
                                <option <?php if($user['wilaya'] == '39') echo 'selected'; ?> value="39">39 - El Oued</option>
                                <option <?php if($user['wilaya'] == '40') echo 'selected'; ?> value="40">40 - Khenchela</option>
                                <option <?php if($user['wilaya'] == '41') echo 'selected'; ?> value="41">41 - Souk Ahras</option>
                                <option <?php if($user['wilaya'] == '42') echo 'selected'; ?> value="42">42 - Tipaza</option>
                                <option <?php if($user['wilaya'] == '43') echo 'selected'; ?> value="43">43 - Mila</option>
                                <option <?php if($user['wilaya'] == '44') echo 'selected'; ?> value="44">44 - Aïn Defla</option>
                                <option <?php if($user['wilaya'] == '45') echo 'selected'; ?> value="45">45 - Naâma</option>
                                <option <?php if($user['wilaya'] == '46') echo 'selected'; ?> value="46">46 - Aïn Témouchent</option>
                                <option <?php if($user['wilaya'] == '47') echo 'selected'; ?> value="47">47 - Ghardaïa</option>
                                <option <?php if($user['wilaya'] == '48') echo 'selected'; ?> value="48">48 - Relizane</option>
                                <option <?php if($user['wilaya'] == '49') echo 'selected'; ?> value="49">49 - El M'Ghair</option>
                                <option <?php if($user['wilaya'] == '50') echo 'selected'; ?> value="50">50 - El Meniaa</option>
                                <option <?php if($user['wilaya'] == '51') echo 'selected'; ?> value="51">51 - Ouled Djellal</option>
                                <option <?php if($user['wilaya'] == '52') echo 'selected'; ?> value="52">52 - Bordj Baji Mokhtar</option>
                                <option <?php if($user['wilaya'] == '53') echo 'selected'; ?> value="53">53 - Béni Abbès</option>
                                <option <?php if($user['wilaya'] == '54') echo 'selected'; ?> value="54">54 - Timimoun</option>
                                <option <?php if($user['wilaya'] == '55') echo 'selected'; ?> value="55">55 - Touggourt</option>
                                <option <?php if($user['wilaya'] == '56') echo 'selected'; ?> value="56">56 - Djanet</option>
                                <option <?php if($user['wilaya'] == '57') echo 'selected'; ?> value="57">57 - In Salah</option>
                                <option <?php if($user['wilaya'] == '58') echo 'selected'; ?> value="58">58 - In Guezzam</option>
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