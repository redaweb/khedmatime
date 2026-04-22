<?php
session_start();
include '../config/db.php';

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $pdo->beginTransaction(); 

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $wilaya = $_POST['wilaya'];
        $role = $_POST['role'];
        $mdp = $_POST['password']; 
        $password = password_hash($mdp, PASSWORD_DEFAULT);

        $sql = "INSERT INTO utilisateur 
                (nom, prenom, telephone, adress, wilaya, mot_de_passe)
                VALUES (:nom, :prenom, :telephone, :adresse, :wilaya, :password)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':telephone' => $telephone,
            ':adresse' => $adresse,
            ':wilaya' => $wilaya,
            ':password' => $password
        ]);

        $id_user = $pdo->lastInsertId();

        if ($role === "Prestataire") {

            $sqlPrestataire = "INSERT INTO prestataire (id_prestataire)
                               VALUES (:id)";
            $stmtPrestataire = $pdo->prepare($sqlPrestataire);
            $stmtPrestataire->execute([
                ':id' => $id_user
            ]);

        } elseif ($role === "client") {

            $sqlClient = "INSERT INTO client (id_client)
                          VALUES (:id)";
            $stmtClient = $pdo->prepare($sqlClient);
            $stmtClient->execute([
                ':id' => $id_user
            ]);

        } else {
            throw new Exception("Rôle invalide");
        }

        $pdo->commit(); 

        header('Location: ../view/index.php');
        exit();

    }

} catch(Exception $e) {

    $pdo->rollBack();
    echo "Erreur : " . $e->getMessage();
}
?>