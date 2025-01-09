<?php require_once "../views/partials/header.php";

?>



<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-blue-800 to-blue-700 text-white shadow-xl flex flex-col" id="sidebar">
        <div class="p-8">
            <h1 class="text-2xl font-bold tracking-tight animate-fade-in">BANKATI</h1>
        </div>
        <nav class="flex-1 mt-6 space-y-2">
            <a href="index.html" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="wallet" class="w-5 h-5"></i>
                <span>Tableau de bord</span>
            </a>
            <a href="/user/myAccounts" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="credit-card" class="w-5 h-5"></i>
                <span>Mes comptes</span>
            </a>
            <a href="/user/virements" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30 ">
                <i data-lucide="send" class="w-5 h-5"></i>
                <span>Virements</span>
            </a>
            <a href="/user/historique" class="nav-link flex items-center w-full p-4 space-x-3 bg-blue-600/50 backdrop-blur">
                <i data-lucide="history" class="w-5 h-5"></i>
                <span>Historique</span>
            </a>
            <a href="/user/profile" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="user" class="w-5 h-5"></i>
                <span>Profil</span>
            </a>
        </nav>
        <div class="p-4 border-t border-blue-600/30">
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
    <div class="flex-1 ml-64">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <h1 class="text-3xl font-bold text-gray-900">Historique des transactions</h1>
                    <a href="/user/virements" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Nouvelle transaction
                    </a>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Résumé Cards with Animation -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow animate__animated animate__fadeInUp">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total des entrées</p>
                            <p class="text-2xl font-bold text-green-600 mt-1">+ <?= $totalDepot[0]["total"] ?>€</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i data-lucide="arrow-down-right" class="w-6 h-6 text-green-600"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <canvas id="incomingChart" height="60"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total des sorties</p>
                            <p class="text-2xl font-bold text-red-600 mt-1">- <?= $totalRetraits[0]["total"] ?>€</p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <i data-lucide="arrow-up-right" class="w-6 h-6 text-red-600"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <canvas id="outgoingChart" height="60"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Solde de la période</p>
                            <p class="text-2xl font-bold text-blue-600 mt-1">+<?= $difference ?>€</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i data-lucide="wallet" class="w-6 h-6 text-blue-600"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <canvas id="balanceChart" height="60"></canvas>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="bg-white rounded-xl shadow-sm mb-8 border border-gray-100 animate__animated animate__fadeIn" style="animation-delay: 0.3s;">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Filtres</h3>
                        <button class="text-sm text-gray-500 hover:text-gray-700" id="toggleFilters">
                            <i data-lucide="sliders" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <div id="filterContent" class="">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Compte</label>
                                <select class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-500">
                                    <option>Tous les comptes</option>
                                    <option>Compte Courant</option>
                                    <option>Compte Épargne</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Période</label>
                                <select class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-500">
                                    <option>7 derniers jours</option>
                                    <option>30 derniers jours</option>
                                    <option>3 derniers mois</option>
                                    <option>12 derniers mois</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                                <select class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-500">
                                    <option>Toutes les opérations</option>
                                    <option>dépôts uniquement</option>
                                    <option>retraits uniquement</option>
                                    <option>transferts uniquement</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Montant</label>
                                <div class="flex space-x-4">
                                    <input type="number" placeholder="Min" class="w-1/2 rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-500">
                                    <input type="number" placeholder="Max" class="w-1/2 rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6 space-x-4">
                            <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                Réinitialiser
                            </button>
                            <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                                Appliquer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 animate__animated animate__fadeIn" style="animation-delay: 0.4s;">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Transactions récentes</h3>
                        <button class="flex items-center text-sm text-blue-600 hover:text-blue-700">
                            <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                            Exporter
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Libellé</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Compte</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15 Jan 2025</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">Virement à John Doe</div>
                                        <div class="text-sm text-gray-500">Remboursement restaurant</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            Virement
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Compte Courant</td>
                                    <td class="px-6 py-4 text-sm font-medium text-right text-red-600">- 125.00 €</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">14 Jan 2025</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">Salaire Entreprise XYZ</div>
                                        <div class="text-sm text-gray-500">Salaire Janvier 2025</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Virement reçu
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Compte Courant</td>
                                    <td class="px-6 py-4 text-sm font-medium text-right text-green-600">+ 2,500.00 €</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Toggle filters
        const toggleFilters = document.getElementById('toggleFilters');
        const filterContent = document.getElementById('filterContent');

        toggleFilters.addEventListener('click', () => {
            filterContent.classList.toggle('hidden');
            toggleFilters.querySelector('i').classList.toggle('rotate-180');
        });
    </script>

    <?php require_once "../views/partials/footer.php" ?>