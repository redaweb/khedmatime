<?php
include '../includes/auth_middleware.php';
include '../includes/header.php';
include '../config/db.php';
requireLogin('../view/login.php');
$user_id = currentUserId();

try {
    $stmt = $pdo->prepare("SELECT * FROM prestataire WHERE id_prestataire = :id");
    $stmt->execute(['id' => $user_id]);
    $prestataire = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$prestataire) {
        die("Accès refusé. أنت لست prestataire.");
    }

    $stmt_services = $pdo->prepare("SELECT * FROM service WHERE id_prestataire = :id");
    $stmt_services->execute(['id' => $user_id]);
    $services = $stmt_services->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
