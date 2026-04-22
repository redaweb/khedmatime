<?php
include '../includes/auth_middleware.php';
include '../config/db.php';

requireLogin('../view/login.php');

$adminId = currentUserId();
$stmtAdmin = $pdo->prepare("SELECT role FROM utilisateur WHERE id_utilisateur = :id");
$stmtAdmin->execute([':id' => $adminId]);
$adminUser = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

if (!$adminUser || ($adminUser['role'] ?? '') !== 'admin') {
    die("Accès refusé. Profil admin requis.");
}

$stmtPrestataires = $pdo->query(
    "SELECT p.id_prestataire, p.statut, p.diplome_path, p.validated_at, u.nom, u.prenom, u.telephone, u.wilaya
     FROM prestataire p
     JOIN utilisateur u ON u.id_utilisateur = p.id_prestataire
     ORDER BY FIELD(p.statut, 'en_attente', 'refuse', 'accepte'), p.id_prestataire DESC"
);
$prestataires = $stmtPrestataires->fetchAll(PDO::FETCH_ASSOC);

$stmtUsers = $pdo->query(
    "SELECT id_utilisateur, nom, prenom, telephone, role FROM utilisateur ORDER BY id_utilisateur DESC"
);
$users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
?>
