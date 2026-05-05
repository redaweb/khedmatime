<?php
session_start();

$categoryKey = isset($_GET['categorie']) ? strtolower(trim($_GET['categorie'])) : '';

$categoriesConfig = [
    'plomberie' => [
        'category' => 'Plombier',
        'iconClass' => 'fas fa-faucet',
        'title' => 'Artisans en Plomberie',
        'countLabel' => 'plombiers disponibles',
        'emptyIconClass' => 'fas fa-faucet',
        'emptyTitle' => 'Aucun plombier trouve',
        'emptyText' => 'Soyez le premier plombier a proposer vos services ici !',
        'emptyButtonText' => 'Proposer mes services',
    ],
    'electricite' => [
        'category' => 'Electricité',
        'iconClass' => 'fas fa-bolt',
        'title' => 'Artisans en Electricite',
        'countLabel' => 'electriciens qualifies',
        'emptyIconClass' => 'fas fa-bolt',
        'emptyTitle' => 'Aucun electricien trouve',
        'emptyText' => 'Soyez le premier a proposer vos services electriques !',
        'emptyButtonText' => 'Proposer mes services',
    ],
    'climatisation' => [
        'category' => 'climatisation',
        'iconClass' => 'fas fa-snowflake',
        'title' => 'Artisans en Climatisation',
        'countLabel' => 'specialistes disponibles',
        'emptyIconClass' => 'fas fa-wind',
        'emptyTitle' => 'Aucun technicien trouve',
        'emptyText' => "Besoin d'un coup de frais ? Revenez bientot !",
        'emptyButtonText' => 'Proposer mes services',
    ],
    'menuiserie' => [
        'category' => 'Menuiserie',
        'iconClass' => 'fas fa-hammer',
        'title' => 'Artisans en Menuiserie',
        'countLabel' => 'experts disponibles',
        'emptyIconClass' => 'fas fa-hammer',
        'emptyTitle' => 'Aucun artisan trouve',
        'emptyText' => 'Soyez le premier artisan menuisier de votre region !',
        'emptyButtonText' => "Proposer mes services",
    ],
    'mecanique' => [
        'category' => 'Mécanique',
        'iconClass' => 'fas fa-car-side',
        'title' => 'Artisans en Mecanique',
        'countLabel' => 'garagistes et mecaniciens',
        'emptyIconClass' => 'fas fa-tools',
        'emptyTitle' => 'Aucun mecanicien trouve',
        'emptyText' => "Un probleme moteur ? Revenez verifier d'ici peu !",
        'emptyButtonText' => 'Proposer mes services',
    ],
    'peinture' => [
        'category' => 'Peinture',
        'iconClass' => 'fas fa-paint-roller',
        'title' => 'Artisans en Peinture',
        'countLabel' => 'experts disponibles',
        'emptyIconClass' => 'fas fa-paint-brush',
        'emptyTitle' => 'Aucun peintre trouve',
        'emptyText' => 'Devenez le premier artisan peintre de votre region !',
        'emptyButtonText' => "Proposer mes services",
    ],
];

if (!isset($categoriesConfig[$categoryKey])) {
    include '../includes/header.php';
    echo '<div class="container mx-auto px-4 py-12">';
    echo '<h1 class="text-2xl font-bold text-gray-900 mb-2">Categorie invalide</h1>';
    echo '<p class="text-gray-600 mb-6">Choisissez une categorie depuis la page d accueil.</p>';
    echo '<a href="index.php" class="inline-flex items-center bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-orange-500 transition">Retour</a>';
    echo '</div>';//test
    include '../includes/footer.php'; 
    exit;
}

$pageConfig = $categoriesConfig[$categoryKey];
include 'artisans_category_page.php';
?>
