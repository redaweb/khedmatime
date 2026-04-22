<?php
include '../config/db.php';

$listeWilayas = [
    '01' => 'Adrar',
    '02' => 'Chlef',
    '03' => 'Laghouat',
    '04' => 'Oum El Bouaghi',
    '05' => 'Batna',
    '06' => 'Béjaïa',
    '07' => 'Biskra',
    '08' => 'Béchar',
    '09' => 'Blida',
    '10' => 'Bouira',
    '11' => 'Tamanrasset',
    '12' => 'Tébessa',
    '13' => 'Tlemcen',
    '14' => 'Tiaret',
    '15' => 'Tizi Ouzou',
    '16' => 'Alger',
    '17' => 'Djelfa',
    '18' => 'Jijel',
    '19' => 'Sétif',
    '20' => 'Saïda',
    '21' => 'Skikda',
    '22' => 'Sidi Bel Abbès',
    '23' => 'Annaba',
    '24' => 'Guelma',
    '25' => 'Constantine',
    '26' => 'Médéa',
    '27' => 'Mostaganem',
    '28' => 'M\'Sila',
    '29' => 'Mascara',
    '30' => 'Ouargla',
    '31' => 'Oran',
    '32' => 'El Bayadh',
    '33' => 'Illizi',
    '34' => 'Bordj Bou Arreridj',
    '35' => 'Boumerdès',
    '36' => 'El Tarf',
    '37' => 'Tindouf',
    '38' => 'Tissemsilt',
    '39' => 'El Oued',
    '40' => 'Khenchela',
    '41' => 'Souk Ahras',
    '42' => 'Tipaza',
    '43' => 'Mila',
    '44' => 'Aïn Defla',
    '45' => 'Naâma',
    '46' => 'Aïn Témouchent',
    '47' => 'Ghardaïa',
    '48' => 'Relizane',
    '49' => 'El M\'Ghair',
    '50' => 'El Meniaa',
    '51' => 'Ouled Djellal',
    '52' => 'Bordj Baji Mokhtar',
    '53' => 'Béni Abbès',
    '54' => 'Timimoun',
    '55' => 'Touggourt',
    '56' => 'Djanet',
    '57' => 'In Salah',
    '58' => 'In Guezzam'
];
if (!isset($category) || trim($category) === '') {
    die('Categorie manquante.');
}

try {
    $selectedWilaya = trim($_GET['wilaya'] ?? '');
    $useProximite = (($_GET['proximite'] ?? '0') === '1');
    $currentUserWilaya = null;

    if ($useProximite && isset($_SESSION['user_id'])) {
        $stmtUser = $pdo->prepare("SELECT wilaya FROM utilisateur WHERE id_utilisateur = :id");
        $stmtUser->execute([':id' => (int) $_SESSION['user_id']]);
        $currentUserWilaya = $stmtUser->fetchColumn() ?: null;
    }

    $where = [
        "s.categorie = :categorie",
        "p.statut = 'accepte'",
    ];
    $params = [':categorie' => $category];

    if ($selectedWilaya !== '') {
        $where[] = "u.wilaya = :wilaya";
        $params[':wilaya'] = $selectedWilaya;
    } elseif ($useProximite && !empty($currentUserWilaya)) {
        $where[] = "u.wilaya = :wilaya_proximite";
        $params[':wilaya_proximite'] = $currentUserWilaya;
    }

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
            WHERE " . implode(' AND ', $where) . "
            ORDER BY s.id_service DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmtWilayas = $pdo->prepare(
        "SELECT DISTINCT u.wilaya
         FROM service s
         JOIN prestataire p ON s.id_prestataire = p.id_prestataire
         JOIN utilisateur u ON p.id_prestataire = u.id_utilisateur
         WHERE s.categorie = :categorie AND p.statut = 'accepte' AND u.wilaya IS NOT NULL AND u.wilaya <> ''
         ORDER BY u.wilaya ASC"
    );
    $stmtWilayas->execute([':categorie' => $category]);
    $wilayaOptions = $stmtWilayas->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
