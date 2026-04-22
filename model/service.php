<?php
session_start();
include '../config/db.php'; 

if(!isset($_SESSION['id_prestataire'])){
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $type_service = $_POST['role'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];
    $id_prestataire = $_SESSION['id_prestataire']; 

    $imageName = null;
    if(isset($_FILES['galerie']) && $_FILES['galerie']['error'][0] == 0){
        $uploadDir = "../uploads/";

        $tmp_name = $_FILES['galerie']['tmp_name'][0];
        $originalName = $_FILES['galerie']['name'][0];
        $imageName = time() . "_" . $originalName;

        if(!move_uploaded_file($tmp_name, $uploadDir . $imageName)){
            $imageName = null;
        }
    }

    try {
        $sql = "INSERT INTO service (nom, image, description, type_service, categorie, id_prestataire)
                VALUES (:nom, :image, :description, :type_service, :categorie, :id_prestataire)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':image' => $imageName,
            ':description' => $description,
            ':type_service' => $type_service,
            ':categorie' => $categorie,
            ':id_prestataire' => $id_prestataire
        ]);

        header("Location: ../view/dashboard_prestataire.php?success=1");
        exit();

    } catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
}
?>
