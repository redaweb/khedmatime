<?php
include '../includes/auth_middleware.php';
include '../config/db.php';

requireLogin('login.php');

if (isset($_GET['id'])) {
    
    $id_service = $_GET['id'];
    $id_utilisateur = currentUserId();

    $stmt = $pdo->prepare("DELETE FROM service WHERE id_service = ? AND id_prestataire = ?");
    
    if ($stmt->execute([$id_service, $id_utilisateur])) {
        header("Location: dashboard_prestataire.php?status=deleted");
        exit();
    } else {
        echo "Erreur lors de la suppression.";
    }

} else {
    header("Location: dashboard_prestataire.php");
    exit();
}
?>