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
        <!-- Top Navigation -->
        <div class="bg-white shadow">
            <div class="px-8 py-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">Gestion des Clients</h2>
                <button
                    onclick="toggleAddClientModal()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                    <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                    Nouveau Client
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="p-8">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                        <div class="relative">
                            <input
                                type="text"
                                placeholder="Nom, email, ID..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-2"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>Tous les statuts</option>
                            <option>Actif</option>
                            <option>Inactif</option>
                            <option>En attente</option>
                            <option>Bloqué</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type de compte</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>Tous les types</option>
                            <option>Compte Courant</option>
                            <option>Compte Épargne</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Trier par</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>Date d'inscription</option>
                            <option>Nom</option>
                            <option>Solde</option>
                            <option>Activité récente</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Client List -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <table class="min-w-full">
                        <thead>
                            <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="p-3">Client</th>
                                <th class="p-3">Contact</th>
                                <th class="p-3">Comptes</th>
                                <th class="p-3">Statut</th>
                                <th class="p-3">Dernière activité</th>
                                <th class="p-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($clients as $client): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3">
                                        <div class="flex items-center">
                                            <img src="www.placeholder.co/40/40" alt="Thomas Robert" class="w-10 h-10 rounded-full">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900" id="fullName"><?= $client['name'] ?></div>
                                                <div id="client_id" class="text-sm text-gray-500">ID: #<?= 'CLT-' . date("YmdHi", strtotime($client['created_at'])) . $client['id'] ?> </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        <div class="text-sm text-gray-900" id="email"><?= $client['email'] ?></div>
                                        <div class="text-sm text-gray-500" id="phone"><?= $client['phone'] ?></div>
                                    </td>
                                    <td class="p-3">
                                        <?php if (count($client['accounts']) > 1): ?>
                                            <div class="text-sm text-gray-900"> <?= count($client['accounts']) ?> comptes</div>
                                            <div class="text-sm text-gray-500">
                                                <?php foreach ($client['accounts'] as $account): ?>
                                                <?= $account['account_type'];
                                                endforeach ?>
                                            </div>
                                        <?php elseif (count($client['accounts']) > 0): ?>
                                            <div class="text-sm text-gray-900"> 1 compte</div>
                                            <div class="text-sm text-gray-500"><?= $client['accounts'][0]['account_type']; ?></div>
                                        <?php else: ?>
                                            <div class="text-sm text-gray-900">Pas de compte</div>
                                        <?php endif ?>
                                    </td>
                                    <td class="p-3">
                                        <?php if ($client['status'] == 'actif'): ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Actif
                                            </span>
                                        <?php elseif ($client['status'] == 'bloqué'): ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Bloqué
                                            </span>
                                        <?php elseif ($client['status'] == 'en attente'): ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                En attente
                                            </span>
                                        <?php endif ?>
                                    </td>
                                    <td class="p-3">
                                        <div class="text-sm text-gray-900"><?= $client['last_activity']['date'] ?> </div>
                                        <div class="text-sm text-gray-500"><?= $client['last_activity']['type'] ?></div>
                                    </td>
                                    <td class="p-3">
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600 hover:text-blue-900">
                                                <i data-lucide="eye" class="w-5 h-5"></i>
                                            </button>
                                            <button onclick="toggleAddClientModal(true,event)" class="text-gray-600 hover:text-gray-900"
                                                data-client='<?= json_encode([
                                                                    "id" => $client['id'],
                                                                    "num" => 'CLT-' . date("YmdHi", strtotime($client['created_at'])) . $client['id'],
                                                                    "name" => $client["name"],
                                                                    "email" => $client["email"],
                                                                    "phone" => $client["phone"],
                                                                    "address" => $client["address"]
                                                                ]); ?>'>
                                                <i data-lucide="edit" class="w-5 h-5"></i>
                                            </button>
                                            <?php if ($client['status'] == 'actif'): ?>
                                                <button onclick="lockClient(event)" class="text-red-600 hover:text-red-900" data-client='
                                                <?= json_encode(["id" => $client["id"]]); ?>'>
                                                    <i data-lucide="lock" class="w-5 h-5"></i>
                                                </button>
                                            <?php elseif ($client['status'] == 'en attente' || $client['status'] == 'bloqué'): ?>
                                                <button onclick="activateClient(event)" class="text-green-600 hover:text-green-900"
                                                    data-client='<?= json_encode(["id" => $client["id"]]); ?>'>
                                                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                                                </button>
                                            <?php endif ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                    <!-- add client  -->

                    <div id="addClientModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
                        <div class="relative top-10 mx-auto p-5 w-full max-w-2xl">
                            <div class="bg-white rounded-lg shadow-xl">
                                <!-- Modal Header -->
                                <div class="flex justify-between items-center p-6 border-b">
                                    <h3 class="text-lg font-semibold text-gray-900" id="ModalTitle">Ajouter un nouveau client</h3>
                                    <button onclick="toggleAddClientModal()" class="text-gray-400 hover:text-gray-500">
                                        <i data-lucide="x" class="w-6 h-6"></i>
                                    </button>
                                </div>

                                <!-- Modal Body -->
                                <div class="p-6">
                                    <form id="addClientForm" class="space-y-6" method="post">
                                        <!-- Informations personnelles -->
                                        <div>
                                            <h4 class="text-base font-medium text-gray-900 mb-4">Informations personnelles</h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Civilité *</label>
                                                    <select required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                        <option value="">Sélectionner</option>
                                                        <option value="mr">M.</option>
                                                        <option value="mme">Mme</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Numéro client</label>
                                                    <input
                                                        name="num_client"
                                                        type="text"
                                                        readonly
                                                        value="CLT-2024-0001"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                                                    <input
                                                        name="lastname"
                                                        type="text"
                                                        required
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Prénom *</label>
                                                    <input
                                                        name="firstname"
                                                        type="text"
                                                        required
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Coordonnées -->
                                        <div>
                                            <h4 class="text-base font-medium text-gray-900 mb-4">Coordonnées</h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                                    <input
                                                        name="email"
                                                        type="email"
                                                        required
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone *</label>
                                                    <input
                                                        name="phone"
                                                        type="tel"
                                                        required
                                                        pattern="[0-9]{10}"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                </div>

                                                <div class="md:col-span-2">
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Adresse *</label>
                                                    <input
                                                        name="address"
                                                        type="text"
                                                        required
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Type de compte -->
                                        <div id="account_config">
                                            <h4 class="text-base font-medium text-gray-900 mb-4">Configuration du compte</h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Type de compte *</label>
                                                    <select required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="account_type">
                                                        <option value="">Sélectionner</option>
                                                        <option value="courant">Compte Courant</option>
                                                        <option value="epargne">Compte Épargne</option>
                                                        <option value="both">Les deux</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>


                                    </form>
                                </div>

                                <!-- Modal Footer -->
                                <div class="flex justify-end space-x-3 p-6 border-t bg-gray-50">
                                    <button
                                        onclick="toggleAddClientModal()"
                                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                        Annuler
                                    </button>
                                    <button
                                        id="AddClientButton"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        Créer le compte
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center justify-between mt-6">
                        <div class="text-sm text-gray-700">
                            Affichage de 1 à 10 sur <?=count($clients)?> clients
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                                Précédent
                            </button>
                            <button class="px-3 py-1 border bg-blue-50 text-blue-600 rounded">
                                1
                            </button>
                            <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                                2
                            </button>
                            <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                                3
                            </button>
                            <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                                Suivant
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'partials/footer.php'; ?>