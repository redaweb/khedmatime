<?php
include '../includes/auth_middleware.php';
include '../includes/header.php';
include '../config/db.php';
requireLogin('../view/login.php');
$query = "SELECT 
            e.id_evaluation, e.note, 
            s.nom AS service_nom, s.image AS service_image, s.categorie,
            u.nom AS client_nom, u.prenom AS client_prenom, u.photo AS client_photo, u.wilaya
          FROM evaluation e
          INNER JOIN service s ON e.id_service = s.id_service
          INNER JOIN client c ON e.id_client = c.id_client
          INNER JOIN utilisateur u ON c.id_client = u.id_utilisateur
          ORDER BY e.id_evaluation DESC";

$stmt = $pdo->prepare($query);
$stmt->execute();
$evaluations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>