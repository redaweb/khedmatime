<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../config/db.php'; 

$is_prestataire = false;
$is_client = false;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $check_prest = $pdo->prepare("SELECT id_prestataire FROM prestataire WHERE id_prestataire = ?");
    $check_prest->execute([$user_id]);
    if ($check_prest->fetch()) {
        $is_prestataire = true;
    }

    $check_client = $pdo->prepare("SELECT id_client FROM client WHERE id_client = ?");
    $check_client->execute([$user_id]);
    if ($check_client->fetch()) {
        $is_client = true;
    }
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<header class="navbar flex items-center justify-between px-6 bg-white border-b border-gray-100 shadow-sm">
    <div class="themeLogo">
        <div class="imgLogo">
            <a href="index.php">
                <img src="../layout/images/1.png" alt="Logo ServiceÉchange" class="h-10 w-auto">
            </a>
        </div>
    </div>

    <nav class="flex items-center space-x-8">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <div class="hidden md:flex space-x-6">
                <a href="index.php" class="text-gray-600 hover:text-blue-700 font-medium transition">Home</a>
                <a href="comment_ca_marche.php" class="text-gray-600 hover:text-blue-700 font-medium transition">Comment ça marche</a>
                <a href="inscription.php" class="text-gray-600 hover:text-blue-700 font-medium transition">Devenir artisan</a>
                <a href="aide.php" class="text-gray-600 hover:text-blue-700 font-medium transition">Aide</a>
            </div>
        <?php endif; ?>

        <div class="flex items-center">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="flex items-center space-x-6">
                    <a href="mon_profil.php" class="flex items-center space-x-3 group transition">
                        <div class="flex flex-col text-right hidden sm:block">
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest group-hover:text-orange-500 transition">Bienvenue</span>
                            <span class="text-sm font-extrabold text-blue-900 group-hover:text-blue-600">
                                <?php echo htmlspecialchars($_SESSION['prenom'] . " " . $_SESSION['nom']); ?>
                            </span>
                        </div>
                        <div class="w-10 h-10 bg-blue-50 text-blue-700 rounded-full flex items-center justify-center border border-blue-100 group-hover:bg-blue-700 group-hover:text-white transition shadow-sm">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                    </a>

                    <a href="../model/logout.php" 
                       class="flex items-center bg-red-50 hover:bg-red-500 hover:text-white text-red-600 px-4 py-2 rounded-xl text-sm font-bold transition duration-300 border border-red-100 shadow-sm">
                        <i class="fas fa-sign-out-alt mr-1"></i>
                    </a>
                </div>
            <?php else: ?>
                <a href="login.php" 
                   class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-full text-sm font-bold transition duration-300 shadow-md transform active:scale-95">
                    Se connecter
                </a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<?php if (isset($_SESSION['user_id']) && $is_prestataire): ?>
<div class="bg-gray-50 border-b border-gray-200">
    <div class="mx-auto px-6">
        <div class="flex flex-wrap space-x-4 md:space-x-8">
             <a href="index.php" 
               class="py-4 px-2 border-b-2 transition duration-300 text-sm font-bold flex items-center <?php echo ($current_page == 'demandes_prestataire.php') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-blue-700'; ?>">
<i class="fas fa-home mr-2"></i> Home            </a>
            <a href="dashboard_prestataire.php" 
               class="py-4 px-2 border-b-2 transition duration-300 text-sm font-bold flex items-center <?php echo ($current_page == 'dashboard_prestataire.php') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-blue-700'; ?>">
                <i class="fas fa-concierge-bell mr-2"></i> Mes Services
            </a>
            
            <a href="demandes_prestataire.php" 
               class="py-4 px-2 border-b-2 transition duration-300 text-sm font-bold flex items-center <?php echo ($current_page == 'demandes_prestataire.php') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-blue-700'; ?>">
                <i class="fas fa-clipboard-list mr-2"></i> Mes Demandes
            </a>

            <a href="evaluations.php" 
               class="py-4 px-2 border-b-2 transition duration-300 text-sm font-bold flex items-center <?php echo ($current_page == 'evaluations.php') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-blue-700'; ?>">
                <i class="fas fa-star mr-2 text-yellow-500"></i> Évaluations
            </a>

            <a href="services_payants.php" 
               class="py-4 px-2 border-b-2 transition duration-300 text-sm font-bold flex items-center <?php echo ($current_page == 'services_payants.php') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-blue-700'; ?>">
                <i class="fas fa-crown mr-2 text-blue-600"></i> Services Payants
            </a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if (isset($_SESSION['user_id']) && $is_client): ?>
<div class="bg-gray-50 border-b border-gray-200">
    <div class="mx-auto px-6">
        <div class="flex flex-wrap space-x-4 md:space-x-8">
            <a href="index.php" 
               class="py-4 px-2 border-b-2 transition duration-300 text-sm font-bold flex items-center <?php echo ($current_page == 'dashboard_prestataire.php') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-blue-700'; ?>">
                <i class="fas fa-concierge-bell mr-2"></i> Home
            </a>

            <a href="dashboard_client.php" 
               class="py-4 px-2 border-b-2 transition duration-300 text-sm font-bold flex items-center <?php echo ($current_page == 'services_payants.php') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-blue-700'; ?>">
                <i class="fas fa-clipboard-list mr-2"></i> Demande
            </a>
        </div>
    </div>
</div>
<?php endif; ?>