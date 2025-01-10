<?php require_once "../views/partials/header.php";

?>

<div class="min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-gradient-to-br from-blue-900 to-blue-800 text-white shadow-xl">
        <div class="p-6">
            <h1 class="text-3xl font-bold tracking-tight">BANKATI</h1>
        </div>
        <nav class="mt-8 space-y-2 px-4">
            <a href="/user/dashboard" class="flex items-center px-4 py-3 bg-blue-700/50 text-white rounded-lg">
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                <span class="font-medium ml-2">Tableau de bord</span>
            </a>
            <a href="/user/myAccounts" class="flex items-center px-4 py-3 text-gray-100 rounded-lg hover:bg-blue-700/50 transition-all duration-200">
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="font-medium ml-2">Mes comptes</span>
            </a>
            <a href="/user/virements" class="flex items-center px-4 py-3 text-gray-100 rounded-lg hover:bg-blue-700/50 transition-all duration-200">
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
                <span class="font-medium ml-2">Virements</span>
            </a>
            <a href="/user/historique" class="flex items-center px-4 py-3 text-gray-100 rounded-lg hover:bg-blue-700/50 transition-all duration-200">
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="font-medium ml-2">Historique</span>
            </a>
            <a href="/user/profile" class="flex items-center px-4 py-3 text-gray-100 rounded-lg hover:bg-blue-700/50 transition-all duration-200">
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 12c2.28 0 4-1.72 4-4s-1.72-4-4-4-4 1.72-4 4 1.72 4 4 4zm0 2c-3.31 0-6 2.69-6 6h12c0-3.31-2.69-6-6-6z" />
                </svg>
                <span class="font-medium ml-2">Profil</span>
            </a>
        </nav>

        <!-- User Profile Section -->
        <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-blue-800">
            <div class="flex items-center space-x-4 mb-4">
                <div class="w-12 h-12 rounded-full bg-blue-700/50 flex items-center justify-center">
                    <?php foreach ($users as $user) {
                        echo $user["name"][0] . $user["name"][2];
                    } ?>
                </div>
                <div>
                    <?php foreach ($users as $user): ?>
                        <p class="font-medium text-white"><?= $user["name"] ?></p>
                        <p class="text-sm text-blue-200">Client </p>
                    <?php endforeach ?>
                </div>
            </div>
            <a href="/user/logout" onclick="confirm('are you sure you want to logout ')" class="flex text-xl items-center px-4 py-2 font-extrabold text-red-500 rounded-lg bg-red-100 transition-all duration-200">
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="font-medium ml-2">Déconnexion</span>
            </a>
        </div>
    </div>
    <!-- Main Content -->
    <main class="ml-64 p-8">
        <header class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Bonjour, <?php foreach ($users as $user) {
                                                                                echo $user["name"];
                                                                            } ?></h1>
                    <p class="text-gray-600 mt-1">Bienvenue sur votre espace bancaire</p>
                </div>
                <div class="flex space-x-4">
                    <a href="/user/virements" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-sm flex items-center">
                        Nouveau virement
                    </a>
                </div>
            </div>
        </header>

        <!-- Account Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <?php foreach ($accounts as $account): ?>
                <?php
                if ($account["account_type"] == "courant") {
                    echo '<div class="bg-gradient-to-br from-blue-600 to-blue-800 p-8 rounded-2xl text-white shadow-lg">';
                } else {
                    echo '<div class="bg-gradient-to-br from-green-600 to-green-800 p-8 rounded-2xl text-white shadow-lg">';
                }
                ?>
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-xl font-semibold">Compte <?= $account["account_type"] ?></h3>
                        <p class="text-blue-100 mt-1">FR76 1234 5678 9012</p>
                    </div>
                    <div class="bg-white/20 p-2 rounded-lg">
                        <i data-lucide="credit-card" class="w-6 h-6"></i>
                    </div>
                </div>
                <p class="text-4xl font-bold mb-6"><?= $account["balance"] ?> €</p>
                <div class="flex space-x-4">
                </div>
        </div>

        <!-- <div class="bg-gradient-to-br from-green-600 to-green-800 p-8 rounded-2xl text-white shadow-lg">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="text-xl font-semibold">Compte Épargne</h3>
                    <p class="text-green-100 mt-1">FR76 9876 5432 1098</p>
                </div>
                <div class="bg-white/20 p-2 rounded-lg">
                    <i data-lucide="piggy-bank" class="w-6 h-6"></i>
                </div>
            </div>
            <p class="text-4xl font-bold mb-6">15,720.50 €</p>
            <div class="flex space-x-4">
                <button class="w-full px-4 py-2 bg-white/20 rounded-lg text-sm font-medium hover:bg-white/30 transition-colors duration-200">
                    <i data-lucide="arrow-right" class="w-4 h-4 inline mr-2"></i>
                    Transférer
                </button>
            </div>
        </div> -->
    <?php endforeach ?>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Dépenses par catégorie</h3>
            <button class="text-gray-500 hover:text-gray-700">
                <i data-lucide="more-horizontal" class="w-5 h-5"></i>
            </button>
        </div>
        <canvas id="expensesChart" height="250"></canvas>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Évolution du solde</h3>
            <button class="text-gray-500 hover:text-gray-700">
                <i data-lucide="more-horizontal" class="w-5 h-5"></i>
            </button>
        </div>
        <canvas id="balanceChart" height="250"></canvas>
    </div>
</div>

<!-- Recent Transactions -->
<div class="bg-white rounded-xl shadow-sm">
    <div class="p-6 border-b border-gray-100">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Transactions récentes</h3>
            <div class="relative">
                <input
                    type="text"
                    id="searchTransactions"
                    placeholder="Rechercher une transaction..."
                    class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
            </div>
        </div>
    </div>
    <div class="divide-y divide-gray-100" id="transactionsList">
        <!-- Transactions will be populated by JavaScript -->
    </div>
</div>
</main>
</div>

<?php require_once "../views/partials/footer.php" ?>