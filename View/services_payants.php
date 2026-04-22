<?php include '../model/services_payants.php'; ?>

<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-crown text-blue-600 mr-3"></i> Historique des Services Payants
        </h1>
        <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">
            <?php echo count($paiements); ?> Transaction(s)
        </span>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Service</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Date de Paiement</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Statut</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php foreach ($paiements as $pay): ?>
                <tr class="hover:bg-blue-50/30 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="../uploads/services/<?php echo $pay['service_image']; ?>" 
                                 class="w-12 h-10 rounded-lg object-cover mr-3 shadow-sm border border-gray-100">
                            <div>
                                <p class="text-sm font-bold text-gray-900"><?php echo htmlspecialchars($pay['service_nom']); ?></p>
                                <p class="text-[11px] text-blue-500 font-semibold uppercase"><?php echo htmlspecialchars($pay['type_service']); ?></p>
                            </div>
                        </div>
                    </td>
                    
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="../uploads/profiles/<?php echo $pay['client_photo'] ?: 'default.png'; ?>" 
                                 class="w-8 h-8 rounded-full object-cover mr-2 shadow-sm border border-white">
                            <span class="text-sm text-gray-700 font-medium">
                                <?php echo htmlspecialchars($pay['prenom'] . ' ' . $pay['nom']); ?>
                            </span>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-600">
                            <i class="far fa-calendar-alt mr-1 text-gray-400"></i>
                            <?php echo date('d/m/Y', strtotime($pay['date_paiement'])); ?>
                            <span class="text-[10px] text-gray-400 block ml-5"><?php echo date('H:i', strtotime($pay['date_paiement'])); ?></span>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <span class="inline-flex items-center bg-green-100 text-green-700 text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-tighter">
                            <i class="fas fa-check-circle mr-1"></i> Payé
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (empty($paiements)): ?>
            <div class="text-center py-16 bg-white">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-dashed border-gray-200">
                    <i class="fas fa-receipt text-gray-300 text-2xl"></i>
                </div>
                <p class="text-gray-400 font-medium italic">Aucun paiement enregistré.</p>
            </div>
        <?php endif; ?>
    </div>
</div>