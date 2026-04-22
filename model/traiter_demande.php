<?php
include '../includes/auth_middleware.php';
include '../config/db.php';

requireLogin('../view/login.php');

$idDemande = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$action = isset($_GET['action']) ? trim($_GET['action']) : '';
$idPrestataire = currentUserId();

if ($idDemande <= 0 || $action === '') {
    header('Location: ../view/demandes_prestataire.php');
    exit();
}

$allowedActions = ['accepter', 'refuser', 'annuler'];
if (!in_array($action, $allowedActions, true)) {
    header('Location: ../view/demandes_prestataire.php');
    exit();
}

$statusMap = [
    'accepter' => 'accepté',
    'refuser' => 'refusé',
    'annuler' => '',
];

try {
    $checkStmt = $pdo->prepare(
        "SELECT d.id_demande
         FROM demande d
         INNER JOIN service s ON d.id_service = s.id_service
         WHERE d.id_demande = :id_demande AND s.id_prestataire = :id_prestataire"
    );
    $checkStmt->execute([
        ':id_demande' => $idDemande,
        ':id_prestataire' => $idPrestataire,
    ]);

    if (!$checkStmt->fetch()) {
        header('Location: ../view/demandes_prestataire.php');
        exit();
    }

    $updateStmt = $pdo->prepare("UPDATE demande SET statut = :statut WHERE id_demande = :id_demande");
    $updateStmt->execute([
        ':statut' => $statusMap[$action],
        ':id_demande' => $idDemande,
    ]);
} catch (PDOException $e) {
    header('Location: ../view/demandes_prestataire.php');
    exit();
}

header('Location: ../view/demandes_prestataire.php');
exit();
?>
