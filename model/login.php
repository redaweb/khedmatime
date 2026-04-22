<?php
session_start();
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $telephone = trim($_POST['telephone']);
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE telephone = :tel");
        $stmt->execute(['tel' => $telephone]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id_utilisateur'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['role'] = $user['role'] ?? 'client';

            if (($_SESSION['role'] ?? '') === 'admin') {
                header("Location: ../view/dashboard_admin.php");
                exit();
            }

            $stmt2 = $pdo->prepare("SELECT * FROM prestataire WHERE id_prestataire = :id");
            $stmt2->execute(['id' => $user['id_utilisateur']]);
            $prestataire = $stmt2->fetch(PDO::FETCH_ASSOC);

            if ($prestataire) {
                if (($prestataire['statut'] ?? 'en_attente') !== 'accepte') {
                    $_SESSION['error'] = "Votre compte prestataire est en attente de validation admin.";
                    header("Location: ../view/login.php");
                    exit();
                }

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