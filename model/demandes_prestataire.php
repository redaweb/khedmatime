<?php
include '../includes/auth_middleware.php';
include '../includes/header.php';
include '../config/db.php';
requireLogin('../view/login.php');
$id_prestataire_connecte = currentUserId();


$sql = "SELECT 
            d.id_demande, 
            d.statut,
            s.nom AS service_nom, 
            s.categorie,
            u.nom AS client_nom, 
            u.prenom AS client_prenom, 
            u.telephone, 
            u.wilaya,
            u.photo
        FROM demande d
        JOIN service s ON d.id_service = s.id_service
        JOIN utilisateur u ON d.id_utilisateur = u.id_utilisateur
        WHERE s.id_prestataire = :id_prestataire";

$stmt = $pdo->prepare($sql);
$stmt->execute(['id_prestataire' => $id_prestataire_connecte]);
$demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>