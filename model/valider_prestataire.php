<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../view/login.php');
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../view/login.php');
    exit();
}

$adminId = (int) $_SESSION['user_id'];
$stmtAdmin = $pdo->prepare("SELECT role FROM utilisateur WHERE id_utilisateur = :id");
$stmtAdmin->execute([':id' => $adminId]);
$admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

if (!$admin || ($admin['role'] ?? '') !== 'admin') {
    die("Accès refusé.");
}

$prestataireId = (int) ($_POST['id_prestataire'] ?? 0);
$action = $_POST['action'] ?? '';

if ($prestataireId <= 0 || !in_array($action, ['accepte', 'refuse'], true)) {
    $_SESSION['error'] = "Demande invalide.";
    header('Location: ../view/dashboard_admin.php');
    exit();
}

$stmtUpdate = $pdo->prepare(
    "UPDATE prestataire
     SET statut = :statut, validated_at = NOW(), validated_by = :admin_id
     WHERE id_prestataire = :prestataire_id"
);
$stmtUpdate->execute([
    ':statut' => $action,
    ':admin_id' => $adminId,
    ':prestataire_id' => $prestataireId,
]);

$_SESSION['success'] = $action === 'accepte'
    ? "Prestataire accepté avec succès."
    : "Prestataire refusé.";

header('Location: ../view/dashboard_admin.php');
exit();
?>
