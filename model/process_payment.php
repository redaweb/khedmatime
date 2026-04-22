<?php
include '../includes/auth_middleware.php';
include '../includes/header.php';
include '../config/db.php';
requireLogin('../view/login.php');

$id_service = $_GET['id_service'];

$stmt = $pdo->prepare("SELECT s.*, u.nom as prest_nom, u.prenom as prest_prenom 
                      FROM service s 
                      JOIN utilisateur u ON s.id_prestataire = u.id_utilisateur 
                      WHERE s.id_service = ?");
$stmt->execute([$id_service]);
$service = $stmt->fetch();

if (!$service) { die("Service introuvable."); }

if (isset($_POST['confirm_pay'])) {
    $id_client = currentUserId();
    $date = date('Y-m-d H:i:s');
    $ins = $pdo->prepare("INSERT INTO paiement (date_paiement, id_service, id_client) VALUES (?, ?, ?)");
    if ($ins->execute([$date, $id_service, $id_client])) {
        // Mettre à jour le statut de la demande
        $upd = $pdo->prepare("UPDATE demande SET statut = 'payé' WHERE id_service = ? AND id_utilisateur = ?");
        $upd->execute([$id_service, $id_client]);
        header('Location: dashboard_client.php?status=success');
        exit();
    }
}
?>