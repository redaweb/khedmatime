<?php include '../model/dashboard_client.php'; ?>

<div class="bg-gray-50 min-h-screen pb-12">
    <div class="max-w-7xl mx-auto px-6 py-8">
        <header class="mb-10">
            <h1 class="text-3xl font-extrabold text-blue-900">Tableau de bord Client</h1>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <h2 class="text-xl font-bold text-gray-800 italic">Suivi de mes demandes</h2>
                <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($liste_demandes as $d): ?>
                            <tr class="hover:bg-gray-50/50">
                                <td class="px-6 py-4">
                                    <p class="font-bold text-gray-900"><?php echo htmlspecialchars($d['service_nom']); ?></p>
                                    <p class="text-xs text-gray-500">Artisan: <?php echo htmlspecialchars($d['prest_nom']); ?></p>
                                </td>
                                <td class="px-6 py-4 text-sm"><?php echo $d['date_demande']; ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-yellow-100 text-yellow-700">
                                        <?php echo $d['statut']; ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <h2 class="text-xl font-bold text-gray-800">À payer</h2>
                <?php foreach ($services_a_payer as $demande): ?>
                    <div class="bg-white p-5 rounded-2xl border-2 border-orange-100 shadow-sm">
                        <h3 class="font-bold text-gray-900"><?php echo htmlspecialchars($demande['service_nom']); ?></h3>
                        <p class="text-2xl font-black text-blue-900"><?php echo $demande['prix']; ?> DZD</p>
                        <a href="process_payment.php?id_service=<?php echo $demande['id_service']; ?>"
                            class="block mt-4 text-center bg-orange-500 text-white font-bold py-3 rounded-xl">
                            Payer maintenant
                        </a>
                    </div>
                <?php endforeach; ?>
                
                <?php if(empty($services_a_payer)): ?>
                    <p class="text-gray-400 text-center italic">Aucun paiement en attente.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>