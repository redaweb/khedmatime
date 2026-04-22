<?php
include '../includes/header.php';
include '../config/db.php';

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $sql = "SELECT 
                s.id_service,
                s.nom AS service_nom,
                s.image,
                s.description,
                s.type_service,
                s.categorie,
                u.nom AS nom_utilisateur,
                u.prenom AS prenom_utilisateur,
                u.telephone,
                u.wilaya
            FROM service s
            JOIN prestataire p ON s.id_prestataire = p.id_prestataire
            JOIN utilisateur u ON p.id_prestataire = u.id_utilisateur
            WHERE s.categorie = :categorie";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['categorie' => 'Peinture']);
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>