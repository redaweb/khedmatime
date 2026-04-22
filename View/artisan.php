<?php
session_start();
include '../config/db.php'; 
include '../includes/header.php';

$id_service = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_service <= 0) {
    header("Location: index.php");
    exit();
}

$message_status = "";
if (isset($_POST['envoyer_demande'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Veuillez vous connecter pour faire une demande.'); window.location.href='login.php';</script>";
        exit();
    }

    $id_client = $_SESSION['user_id'];
    $statut = 'en attente';
    $date_demande = date('Y-m-d H:i:s');

    $check = $pdo->prepare("SELECT id_demande FROM demande WHERE id_service = ? AND id_utilisateur = ? AND statut = 'en attente'");
    $check->execute([$id_service, $id_client]);
    
    if ($check->fetch()) {
        $message_status = "<div class='bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mb-6 rounded shadow-sm'>Vous avez déjà une demande en attente pour ce service.</div>";
    } else {
        $insert = $pdo->prepare("INSERT INTO demande (id_service, id_utilisateur, statut, date_demande) VALUES (?, ?, ?, ?)");
        if ($insert->execute([$id_service, $id_client, $statut, $date_demande])) {
            $message_status = "<div class='bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm'>Votre demande a été envoyée avec succès !</div>";
        } else {
            $message_status = "<div class='bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm'>Erreur lors de l'envoi de la demande.</div>";
        }
    }
}

$query = "SELECT s.*, u.nom as nom_u, u.prenom as prenom_u, u.telephone, u.wilaya 
          FROM service s 
          JOIN utilisateur u ON s.id_prestataire = u.id_utilisateur 
          WHERE s.id_service = :id";

$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id_service]);
$artisan = $stmt->fetch();

if (!$artisan) {
    echo "<div class='text-center py-20'>Artisan introuvable.</div>";
    exit();
}
?>

<div class="container mx-auto px-4 max-w-4xl">
    
    <?php echo $message_status; ?>

    <a href="javascript:history.back()" class="inline-flex items-center text-blue-700 hover:text-blue-900 font-semibold mb-6 transition">
        <i class="fas fa-arrow-left mr-2"></i> Retour aux résultats
    </a>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        <div class="h-32 bg-gradient-to-r from-blue-900 to-blue-700"></div>
        
        <div class="p-6 md:p-8 -mt-16">
            <div class="flex flex-col md:flex-row items-center md:items-end justify-between gap-6">
                <div class="flex flex-col md:flex-row items-center md:items-end gap-6 text-center md:text-left">
                    <img src="../<?php echo $artisan['image'] ?: 'https://i.pravatar.cc/150?u='.$artisan['id_service']; ?>" 
                         class="w-32 h-32 rounded-3xl border-4 border-white object-cover shadow-lg bg-white">
                    
                    <div class="pb-2">
                        <h1 class="text-3xl font-extrabold text-gray-900">
                            <?php echo htmlspecialchars($artisan['prenom_u'] . " " . $artisan['nom_u']); ?>
                        </h1>
                        <p class="text-blue-700 font-bold text-lg"><?php echo htmlspecialchars($artisan['categorie']); ?></p>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-2 rounded-2xl border border-gray-100 text-gray-600 text-sm font-medium">
                    <i class="fas fa-map-marker-alt text-red-500 mr-2"></i> <?php echo htmlspecialchars($artisan['wilaya']); ?>
                </div>
            </div>

            <hr class="my-8 border-gray-100">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-2xl">
                    <i class="fas fa-phone-alt text-blue-700 text-xl"></i>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold">Contact Direct</p>
                        <p class="font-bold text-gray-900"><?php echo htmlspecialchars($artisan['telephone']); ?></p>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-2xl">
                    <i class="fas fa-tools text-orange-500 text-xl"></i>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold">Spécialité</p>
                        <p class="font-bold text-gray-900"><?php echo htmlspecialchars($artisan['nom']); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-6 flex flex-col md:flex-row justify-between items-center border-t border-gray-100">
            <div class="text-2xl font-bold text-blue-900">
                Mode : <span class="text-blue-700"><?php echo htmlspecialchars($artisan['type_service']); ?></span>
            </div>
            <?php if(stripos($artisan['type_service'], 'echange') !== false): ?>
                <div class="flex items-center text-green-700 font-extrabold text-sm uppercase tracking-wider bg-green-100 px-4 py-2 rounded-full border border-green-200">
                    <i class="fas fa-sync-alt mr-2"></i> Prêt pour l'échange de services
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-10">
        <div class="flex border-b border-gray-100 p-2 bg-gray-50/50">
            <button onclick="openTab(event, 'propos')" class="tab-btn flex-1 py-4 px-6 text-sm font-bold rounded-2xl transition-all active-tab">Description</button>
            <button onclick="openTab(event, 'avis')" class="tab-btn flex-1 py-4 px-6 text-sm font-bold rounded-2xl transition-all text-gray-500">Avis & Retours</button>
        </div>

        <div class="p-8">
            <div id="propos" class="tab-content block">
                <h3 class="text-xl font-bold text-gray-900 mb-4 italic text-blue-900">À propos de ce service</h3>
                <p class="text-gray-600 leading-relaxed">
                    <?php echo nl2br(htmlspecialchars($artisan['description'])); ?>
                </p>
            </div>

            <div id="avis" class="tab-content hidden">
                <p class="text-gray-400 italic">Aucun avis pour le moment sur ce service.</p>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-4 mb-20">
        <form action="" method="POST" class="flex-1">
            <button type="submit" name="envoyer_demande" class="w-full bg-green-600 hover:bg-green-700 text-white py-4 rounded-2xl font-bold text-lg shadow-lg text-center transition-all transform active:scale-95">
                <i class="fas fa-plus-circle mr-2"></i> Faire une demande
            </button>
        </form>
<!--
        <a href="tel:<?php echo $artisan['telephone']; ?>" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-4 rounded-2xl font-bold text-lg shadow-lg text-center transition-all transform active:scale-95">
            <i class="fas fa-phone-alt mr-2"></i> Appeler l'artisan
        </a>-->
    </div>
</div>

<style>
    .active-tab {
        background-color: #f8fafc;
        color: #1e3a8a;
        box-shadow: inset 0 -2px 0 #1e3a8a;
    }
</style>

<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.add("hidden");
        tabcontent[i].classList.remove("block");
    }
    tablinks = document.getElementsByClassName("tab-btn");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active-tab", "text-blue-900");
        tablinks[i].classList.add("text-gray-500");
    }
    document.getElementById(tabName).classList.remove("hidden");
    document.getElementById(tabName).classList.add("block");
    evt.currentTarget.classList.add("active-tab", "text-blue-900");
}
</script>

<?php include '../includes/footer.php'; ?>