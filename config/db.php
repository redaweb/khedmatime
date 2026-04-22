<?php

$host = 'localhost';
$db   = 'servicelocal'; 
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (!function_exists('ensureColumnExists')) {
    function ensureColumnExists(PDO $pdo, string $table, string $column, string $definition): void
    {
        $stmt = $pdo->prepare(
            "SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table AND COLUMN_NAME = :column"
        );
        $stmt->execute([
            ':table' => $table,
            ':column' => $column,
        ]);

        if ((int) $stmt->fetchColumn() === 0) {
            $pdo->exec("ALTER TABLE `$table` ADD COLUMN `$column` $definition");
        }
    }
}

if (!function_exists('ensureAdminAndPrestataireSchema')) {
    function ensureAdminAndPrestataireSchema(PDO $pdo): void
    {
        ensureColumnExists($pdo, 'utilisateur', 'role', "ENUM('client','prestataire','admin') NOT NULL DEFAULT 'client'");
        ensureColumnExists($pdo, 'prestataire', 'statut', "ENUM('en_attente','accepte','refuse') NOT NULL DEFAULT 'en_attente'");
        ensureColumnExists($pdo, 'prestataire', 'diplome_path', "VARCHAR(255) DEFAULT NULL");
        ensureColumnExists($pdo, 'prestataire', 'validated_at', "DATETIME DEFAULT NULL");
        ensureColumnExists($pdo, 'prestataire', 'validated_by', "INT DEFAULT NULL");

        $stmtAdmin = $pdo->query("SELECT COUNT(*) FROM utilisateur WHERE role = 'admin'");
        $hasAdmin = (int) $stmtAdmin->fetchColumn() > 0;

        if (!$hasAdmin) {
            $password = password_hash('admin123', PASSWORD_DEFAULT);
            $insertUser = $pdo->prepare(
                "INSERT INTO utilisateur (nom, prenom, telephone, adress, mot_de_passe, wilaya, photo, role)
                 VALUES (:nom, :prenom, :telephone, :adress, :mot_de_passe, :wilaya, :photo, :role)"
            );
            $insertUser->execute([
                ':nom' => 'Super',
                ':prenom' => 'Admin',
                ':telephone' => 'admin',
                ':adress' => 'System',
                ':mot_de_passe' => $password,
                ':wilaya' => '16',
                ':photo' => 'admin.png',
                ':role' => 'admin',
            ]);
        }
    }
}

ensureAdminAndPrestataireSchema($pdo);
