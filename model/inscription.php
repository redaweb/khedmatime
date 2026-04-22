<?php
session_start();
include '../config/db.php';

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $pdo->beginTransaction(); 

        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
        $adresse = trim($_POST['adresse'] ?? '');
        $wilaya = trim($_POST['wilaya'] ?? '');
        $role = strtolower(trim($_POST['role'] ?? ''));
        $mdp = $_POST['password'] ?? '';
        $password = password_hash($mdp, PASSWORD_DEFAULT);

        if (!in_array($role, ['client', 'prestataire'], true)) {
            throw new Exception("Rôle invalide");
        }

        $stmtTelephone = $pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE telephone = :telephone");
        $stmtTelephone->execute([':telephone' => $telephone]);
        if ((int) $stmtTelephone->fetchColumn() > 0) {
            $pdo->rollBack();
            $_SESSION['error'] = "Numéro déjà utilisé.";
            header('Location: ../view/inscription.php');
            exit();
        }

        $sql = "INSERT INTO utilisateur 
                (nom, prenom, telephone, adress, wilaya, mot_de_passe, role)
                VALUES (:nom, :prenom, :telephone, :adresse, :wilaya, :password, :role)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':telephone' => $telephone,
            ':adresse' => $adresse,
            ':wilaya' => $wilaya,
            ':password' => $password,
            ':role' => $role,
        ]);

        $id_user = $pdo->lastInsertId();

        if ($role === "prestataire") {
            if (!isset($_FILES['diplome']) || $_FILES['diplome']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("Le diplôme est obligatoire pour les prestataires.");
            }

            $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
            $originalName = $_FILES['diplome']['name'];
            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            if (!in_array($extension, $allowedExtensions, true)) {
                throw new Exception("Format de diplôme invalide. Formats acceptés: PDF, JPG, PNG.");
            }

            $uploadDir = '../uploads/diplomas/';
            if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                throw new Exception("Impossible de créer le dossier de diplômes.");
            }

            $fileName = 'diplome_' . $id_user . '_' . time() . '.' . $extension;
            $targetPath = $uploadDir . $fileName;
            if (!move_uploaded_file($_FILES['diplome']['tmp_name'], $targetPath)) {
                throw new Exception("Échec de l'upload du diplôme.");
            }

            $sqlPrestataire = "INSERT INTO prestataire (id_prestataire, statut, diplome_path)
                               VALUES (:id, 'en_attente', :diplome)";
            $stmtPrestataire = $pdo->prepare($sqlPrestataire);
            $stmtPrestataire->execute([
                ':id' => $id_user,
                ':diplome' => 'uploads/diplomas/' . $fileName,
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

        if ($role === 'prestataire') {
            $_SESSION['success'] = "Inscription réussie. Votre compte prestataire est en attente de validation par l'admin.";
            header('Location: ../view/login.php');
            exit();
        }

        header('Location: ../view/index.php');
        exit();

    }

} catch(Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $_SESSION['error'] = "Erreur inscription: " . $e->getMessage();
    header('Location: ../view/inscription.php');
    exit();
}
?>