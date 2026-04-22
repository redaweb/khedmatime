<?php
include '../includes/auth_middleware.php';
include '../config/db.php';
include '../includes/header.php';

requireLogin('login.php');

$idDemande = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$idPrestataire = currentUserId();

if ($idDemande <= 0) {
    header('Location: demandes_prestataire.php');
    exit();
}

$stmt = $pdo->prepare(
    "SELECT
        d.id_demande,
        d.statut,
        d.date_demande,
        s.nom AS service_nom,
        s.description AS service_description,
        s.type_service,
        s.categorie,
        u.nom AS client_nom,
        u.prenom AS client_prenom,
        u.telephone,
        u.wilaya
     FROM demande d
     INNER JOIN service s ON d.id_service = s.id_service
     INNER JOIN utilisateur u ON d.id_utilisateur = u.id_utilisateur
     WHERE d.id_demande = :id_demande AND s.id_prestataire = :id_prestataire"
);
$stmt->execute([
    ':id_demande' => $idDemande,
    ':id_prestataire' => $idPrestataire,
]);
$demande = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$demande) {
    header('Location: demandes_prestataire.php');
    exit();
}
?>

<div class="container mx-auto px-6 py-10 max-w-4xl">
    <a href="demandes_prestataire.php" class="inline-flex items-center text-blue-700 hover:text-blue-900 font-semibold mb-6">
        <i class="fas fa-arrow-left mr-2"></i> Retour aux demandes
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
        <div class="flex justify-between items-start">
            <h1 class="text-2xl font-extrabold text-gray-900">Details de la demande #<?php echo (int) $demande['id_demande']; ?></h1>
            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase bg-blue-100 text-blue-700">
                <?php echo htmlspecialchars($demande['statut']); ?>
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div>
                <p class="text-gray-500 font-semibold mb-1">Client</p>
                <p class="font-bold text-gray-900"><?php echo htmlspecialchars($demande['client_prenom'] . ' ' . $demande['client_nom']); ?></p>
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">Telephone</p>
                <p class="font-bold text-gray-900"><?php echo htmlspecialchars($demande['telephone']); ?></p>
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">Wilaya</p>
                <p class="font-bold text-gray-900"><?php echo htmlspecialchars($demande['wilaya']); ?></p>
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">Date de la demande</p>
                <p class="font-bold text-gray-900"><?php echo htmlspecialchars($demande['date_demande']); ?></p>
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">Service</p>
                <p class="font-bold text-gray-900"><?php echo htmlspecialchars($demande['service_nom']); ?></p>
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">Categorie</p>
                <p class="font-bold text-gray-900"><?php echo htmlspecialchars($demande['categorie']); ?></p>
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">Mode</p>
                <p class="font-bold text-gray-900"><?php echo htmlspecialchars($demande['type_service']); ?></p>
            </div>
        </div>

        <div>
            <p class="text-gray-500 font-semibold mb-1">Description du service</p>
            <p class="text-gray-700 leading-relaxed"><?php echo nl2br(htmlspecialchars($demande['service_description'])); ?></p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
