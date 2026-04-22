<?php include '../model/process_payment.php'; ?>

<div class="bg-slate-50 min-h-screen flex items-center justify-center py-12 px-6">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl p-8">
        <h1 class="text-2xl font-bold text-center mb-6 text-blue-600">Finaliser le Paiement</h1>
        
        <div class="bg-gray-50 p-4 rounded-2xl mb-6 flex items-center">
            <img src="../uploads/services/<?php echo $service['image']; ?>" class="w-16 h-16 rounded-xl object-cover mr-4">
            <div>
                <h2 class="font-bold"><?php echo htmlspecialchars($service['nom']); ?></h2>
                <p class="text-sm text-gray-500">Artisan : <?php echo $service['prest_nom']; ?></p>
            </div>
        </div>

        <div class="flex justify-between items-center mb-8">
            <span class="text-gray-600 italic">Total à payer</span>
            <span class="text-2xl font-black text-blue-700"><?php echo number_format($service['prix'], 2); ?> DZD</span>
        </div>

        <form method="POST">
            <button type="submit" name="confirm_pay" 
                    class="w-full bg-blue-600 text-white font-extrabold py-4 rounded-2xl shadow-lg hover:bg-blue-700 transition">
                Confirmer le paiement
            </button>
        </form>
    </div>
</div>