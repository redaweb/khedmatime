<?php
include '../includes/auth_middleware.php';
include '../includes/header.php';
include '../config/db.php';
requireLogin('../view/login.php');

$query = "SELECT 
            p.id_paiement, p.date_paiement, 
            s.nom AS service_nom, s.image AS service_image, s.type_service,
            u.nom AS client_nom, u.prenom AS client_prenom, u.photo AS client_photo
          FROM paiement p
          INNER JOIN service s ON p.id_service = s.id_service
          INNER JOIN client c ON p.id_client = c.id_client
          INNER JOIN utilisateur u ON c.id_client = u.id_utilisateur
          ORDER BY p.date_paiement DESC";

$stmt = $pdo->prepare($query);
$stmt->execute();
$paiements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>