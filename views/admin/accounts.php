<?php require_once 'partials/header.php'; ?>
<div class="flex min-h-screen">
    <button
        onclick="toggleSidebar()"
        class="lg:hidden fixed top-4 left-4 z-50 bg-gray-900 text-white p-2 rounded-lg">
        <i data-lucide="menu" class="w-6 h-6"></i>
    </button>

    <!-- Sidebar avec classe pour contrôler la visibilité -->
    <?php require_once 'partials/sidebar.php'; ?>
    <!-- Main Content -->
    <div class="flex-1">
        <!-- Top Navigation existant -->
        <div class="bg-white shadow">
            <div class="px-8 py-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">Gestion des Comptes</h2>
                <button onclick="toggleAccountActionsModal()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                    <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
                    Nouveau Compte
                </button>
            </div>
        </div>

        <!-- Content -->
        <div class="p-8">
            <!-- Statistics Cards existant -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- ... Cartes existantes ... -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Comptes Actifs</p>
                            <p class="text-2xl font-bold text-gray-900"> <?= $activeAccounts; ?> </p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                        </div>
                    </div>
                    <?php if ($activePercent > 0): ?>
                        <p class="text-sm text-green-600 mt-2"> <?= $activePercent . '% '; ?> ce mois</p>
                    <?php else: ?>
                        <p class="text-sm text-red-600 mt-2"> <?= $activePercent . '% '; ?> ce mois</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Filters existant -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <!-- ... Filtres existants ... -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                        <div class="relative">
                            <input type="text" placeholder="N° compte, nom client..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-2"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type de compte</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>Tous les types</option>
                            <option>Compte Courant</option>
                            <option>Compte Épargne</option>
                            <option>Compte Joint</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>Tous les statuts</option>
                            <option>Actif</option>
                            <option>En attente</option>
                            <option>Bloqué</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Solde</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>Tous les soldes</option>
                            <option>Négatif</option>
                            <option>0 - 1000€</option>
                            <option>> 1000€</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table existante -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- ... Table existante ... -->
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Compte
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Client
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Solde
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dernière Activité
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Account 1 -->
                        <?php foreach ($accounts as $account): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"> <?= $account['account_id'] ?> </div>
                                    <div class="text-sm text-gray-500">#ACC-001</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img src="/api/placeholder/40/40" alt="" class="h-10 w-10 rounded-full">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"> <?= $account['name'] ?> </div>
                                            <div class="text-sm text-gray-500"> <?= $account['email'] ?> </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Compte <?= $account['account_type'] ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= $account['balance'] ?></div>
                                    <div class="text-xs text-green-600">+350€ ce mois</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($account['account_status'] == 'actif'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Actif
                                        </span>
                                    <?php elseif ($account['account_status'] == 'bloqué'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Bloqué
                                        </span>
                                    <?php elseif ($account['account_status'] == 'en attente'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>
                                    <?php endif ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"></div>
                                    <div class="text-sm text-gray-500">Virement sortant</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-900">
                                            <i data-lucide="eye" class="w-5 h-5"></i>
                                        </button>
                                        <button class="text-gray-600 hover:text-gray-900">
                                            <i data-lucide="edit" class="w-5 h-5"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900">
                                            <i data-lucide="lock" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ajout/Modification Compte -->
<div id="accountActionsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 w-full max-w-2xl">
        <div class="bg-white rounded-lg shadow-xl">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Ajouter un nouveau compte</h3>
                <button onclick="toggleAccountActionsModal()" class="text-gray-400 hover:text-gray-500">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form id="accountForm" class="space-y-6">
                    <!-- Sélection du client -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Client titulaire *</label>
                        <select required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionner un client</option>
                            <option value="1">Thomas Robert - #CLT001</option>
                            <option value="2">Marie Dubois - #CLT002</option>
                        </select>
                    </div>

                    <!-- Type de compte -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type de compte *</label>
                            <select required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                onchange="toggleSavingsFields(this.value)">
                                <option value="">Sélectionner</option>
                                <option value="courant">Compte Courant</option>
                                <option value="epargne">Compte Épargne</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agence *</label>
                            <select required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionner</option>
                                <option value="1">Paris Centre (#001)</option>
                                <option value="2">Lyon Centre (#002)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Paramètres du compte -->
                    <div class="space-y-4">
                        <h4 class="text-base font-medium text-gray-900">Paramètres du compte</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Plafond de retrait
                                    *</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">€</span>
                                    </div>
                                    <input type="number" required min="0"
                                        class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="1000">
                                </div>
                            </div>

                            <div id="decouvertField">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Découvert
                                    autorisé</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">€</span>
                                    </div>
                                    <input type="number" min="0"
                                        class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="500">
                                </div>
                            </div>

                            <div id="tauxInteretField" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Taux d'intérêt
                                    annuel</label>
                                <div class="relative">
                                    <input type="number" step="0.01" min="0" max="100"
                                        class="w-full pr-8 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="2.5">
                                    <div
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="space-y-4">
                        <h4 class="text-base font-medium text-gray-900">Options du compte</h4>

                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-blue-600" checked>
                                <span class="ml-2 text-sm text-gray-700">Activer la carte bancaire</span>
                            </label>

                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-blue-600" checked>
                                <span class="ml-2 text-sm text-gray-700">Autoriser les paiements en ligne</span>
                            </label>

                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-blue-600" checked>
                                <span class="ml-2 text-sm text-gray-700">Activer les notifications SMS</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end space-x-3 p-6 border-t bg-gray-50">
                <button onclick="toggleAccountActionsModal()"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Annuler
                </button>
                <button onclick="submitAccountForm()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Créer le compte
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Overlay pour mobile -->
<div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black bg-opacity-50 lg:hidden hidden z-20">
</div>
<?php require_once 'partials/footer.php'; ?>