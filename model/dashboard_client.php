<?php

include '../includes/auth_middleware.php';
include '../includes/header.php';
include '../config/db.php';
requireLogin('../view/login.php');


$id_client = currentUserId(); 
$stmt_demandes = $pdo->prepare("SELECT d.*, s.nom as service_nom, s.image as service_img, u.nom as prest_nom 
                   FROM demande d
                   JOIN service s ON d.id_service = s.id_service
                   JOIN utilisateur u ON s.id_prestataire = u.id_utilisateur
                   WHERE d.id_utilisateur = ? AND d.statut != 'payé'
                   ORDER BY d.date_demande DESC");
$stmt_demandes->execute([$id_client]);
$liste_demandes = $stmt_demandes->fetchAll(PDO::FETCH_ASSOC);

$stmt_a_payer = $pdo->prepare("SELECT d.*, s.nom as service_nom, s.prix, s.id_service
                  FROM demande d
                  JOIN service s ON d.id_service = s.id_service
                  WHERE d.id_utilisateur = ? AND d.statut = 'accepté'
                  AND d.id_service NOT IN (SELECT id_service FROM paiement WHERE id_client = ?)");
$stmt_a_payer->execute([$id_client, $id_client]);
$services_a_payer = $stmt_a_payer->fetchAll(PDO::FETCH_ASSOC);
?>