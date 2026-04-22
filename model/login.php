<?php
session_start();
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $telephone = $_POST['telephone'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE telephone = :tel");
        $stmt->execute(['tel' => $telephone]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id_utilisateur'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];

            $stmt2 = $pdo->prepare("SELECT * FROM prestataire WHERE id_prestataire = :id");
            $stmt2->execute(['id' => $user['id_utilisateur']]);
            $prestataire = $stmt2->fetch(PDO::FETCH_ASSOC);

            if ($prestataire) {
                header("Location: ../view/dashboard_prestataire.php");
                exit();
            } else {
                header("Location: ../view/dashboard_client.php");
                exit();
            }

        } else {
            $_SESSION['error'] = "Numéro ou mot de passe incorrect";
            header("Location: ../view/login.php");
            exit();
        }

    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
} else {
    header("Location: ../view/login.php");
    exit();
}
?>