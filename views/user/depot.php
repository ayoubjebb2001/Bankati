<?php require_once "../views/partials/header.php";

?>
<div class="flex flex-wrap md:flex-nowrap h-screen">
    <!-- Sidebar -->
    <div class="w-full md:w-1/5 bg-gradient-to-b from-blue-800 to-blue-700 text-white shadow-xl" id="sidebar">
        <div class="p-8">
            <h1 class="text-2xl font-bold tracking-tight animate-fade-in">BANKATI</h1>
        </div>
        <nav class="mt-6 space-y-2">
            <a href="index.html" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="wallet" class="w-5 h-5"></i>
                <span>Tableau de bord</span>
            </a>
            <a href="/user/myAccounts" class="nav-link flex items-center w-full p-4 space-x-3 bg-blue-600/50 backdrop-blur">
                <i data-lucide="credit-card" class="w-5 h-5"></i>
                <span>Mes comptes</span>
            </a>
            <a href="virement.html" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="send" class="w-5 h-5"></i>
                <span>Virements</span>
            </a>
            <a href="benificier.html" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span>Bénéficiaires</span>
            </a>
            <a href="historique.html" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="history" class="w-5 h-5"></i>
                <span>Historique</span>
            </a>
            <a href="/user/profile" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="user" class="w-5 h-5"></i>
                <span>Profil</span>
            </a>
        </nav>
        <div class="p-4 border-t border-blue-600/30 mt-auto">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-blue-600/30 flex items-center justify-center">
                    <i data-lucide="user" class="w-6 h-6"></i>
                </div>
                <div>
                    <?php foreach ($users as $user): ?>
                        <p class="font-medium"><?= $user["name"] ?></p>
                        <p class="text-sm text-blue-200">Client</p>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 space-y-6 bg-gray-50 overflow-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Dépôt d'argent</h2>
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 space-y-6">
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Déposer de l'argent</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Veuillez saisir le montant que vous souhaitez déposer sur votre compte
                    </p>
                </div>
                <form id="addFundsForm" action="/user/myAccounts/depots/send" method="post" class="space-y-6">
                    <div class="space-y-4">
                        <div>
                            <input type="text" name="id" value="<?= $compteID ?>" class="hidden">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Montant à déposer</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">€</span>
                                </div>
                                <input name="money" type="number" id="amount" class="block w-full pl-7 pr-12 py-3 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="0.00" required min="0.01" step="0.01" />
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Motif du dépôt (optionnel)</label>
                            <textarea id="description" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Ajoutez une note pour ce dépôt"></textarea>
                        </div>
                    </div>

                    <div class="bg-gray-50 -mx-6 -mb-6 px-6 py-4">
                        <div class="flex justify-end space-x-4">
                            <button type="button" onclick="window.history.back()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Annuler
                            </button>
                            <button type="submit" name="depot" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Confirmer le dépôt
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php require_once "../views/partials/footer.php" ?>