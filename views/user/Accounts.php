<?php require_once "../views/partials/header.php";

?>


<style>
    /* Custom animations */
    @keyframes slideIn {
        from {
            transform: translateX(-20px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .animate-slide-in {
        animation: slideIn 0.3s ease-out forwards;
    }

    /* Hover effect for cards */
    .account-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .account-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>


<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Sidebar -->
    <div class="w-full md:w-1/5 bg-gradient-to-b from-blue-800 to-blue-700 text-white shadow-xl" id="sidebar">
        <div class="p-8">
            <h1 class="text-2xl font-bold tracking-tight animate-fade-in">BANKATI</h1>
        </div>
        <nav class="mt-6">
            <a href="index.html" class="nav-link flex items-center w-full p-4 space-x-3  hover:bg-blue-600/30">
                <i data-lucide="wallet" class="w-5 h-5"></i>
                <span>Tableau de bord</span>
            </a>
            <a href="/user/myAccounts" class="nav-link flex items-center w-full p-4 space-x-3 bg-blue-600/50 backdrop-blur">
                <i data-lucide="credit-card" class="w-5 h-5"></i>
                <span>Mes comptes</span>
            </a>
            <a href="/user/virements" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
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
            <div class="p-4 border-t border-blue-600/30 mt-auto">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-blue-600/30 flex items-center justify-center">
                        <i data-lucide="user" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <?php
                        foreach ($users as $user):
                        ?>
                            <p class="font-medium"><?= $user["name"] ?></p>
                            <p class="text-sm text-blue-200">Client</p>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content with enhanced styling -->
    <div class="flex-1 p-8 space-y-6">
        <h2 class="text-3xl font-bold text-gray-800 animate-slide-in">
            Mes Comptes
        </h2>

        <!-- Account Cards with enhanced styling -->
        <div class="grid gap-6 md:grid-cols-2">
            <!-- Current Account -->
            <?php foreach ($accounts as $account): ?>
                <div class="account-card bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 space-y-6">
                        <div class="flex justify-between items-center">
                            <div class="space-y-1">
                                <h3 class="text-xl font-semibold text-gray-800">Compte <?= $account["account_type"] ?></h3>
                                <p class="text-sm text-gray-500 font-mono">FR76 1234 5678 9012</p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold text-gray-900">€<?= $account["balance"] ?></p>
                                <?php
                                if ($account["account_status"] == "actif") {
                                    echo
                                    '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 animate-pulse">
                                        Actif
                                    </span>';
                                } else if ($account["account_status"] == "inactif") {
                                    echo
                                    '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    Inactif
                                    </span>';
                                } else if ($account["account_status"] == "en attente") {
                                    echo
                                    '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 animate-bounce">
                                    En Attente
                                    </span>
                                    ';
                                } else if ($account["account_status"] == "bloqué") {
                                    echo
                                    '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    Bloqué
                                    </span>
                                    ';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <a href="/user/myAccounts/depots?id=<?= $account['id'] ?>" class="group flex items-center justify-center p-3 text-blue-600 border border-blue-600 rounded-lg transition-all duration-200 hover:bg-blue-600 hover:text-white">
                                <i data-lucide="plus-circle" class="w-5 h-5 mr-2 transition-transform duration-200 group-hover:rotate-90"></i>
                                Alimenter
                            </a>
                            <a href="/user/myAccounts/retrait?id=<?= $account['id'] ?>" class="group flex items-center justify-center p-3 text-purple-600 border border-purple-600 rounded-lg transition-all duration-200 hover:bg-purple-600 hover:text-white">
                                <i data-lucide="download" class="w-5 h-5 mr-2 transition-transform duration-200 group-hover:translate-y-1"></i>
                                Relevé
                            </a>
                        </div>

                        <!-- Account details with hover effect -->
                        <div class="pt-6 border-t border-gray-100">
                            <h4 class="font-medium text-gray-700 mb-4">Détails du compte</h4>
                            <dl class="grid grid-cols-2 gap-4">
                                <!-- Detail items with hover effect -->
                                <div class="p-3 rounded-lg transition-colors duration-200 hover:bg-gray-50">
                                    <dt class="text-sm text-gray-500">Date d'ouverture</dt>
                                    <dd class="mt-1 text-sm font-medium text-gray-900"><?= $account["created_at"] ?></dd>
                                </div>
                                <!-- Add similar styling to other detail items -->
                            </dl>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>

            <!-- Savings Account - Similar styling -->
        </div>
    </div>
</div>

<!-- Modal with enhanced animations -->
<div id="alimenterCompteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative top-20 mx-auto p-5 w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="bg-white rounded-xl shadow-xl">
            <!-- Modal content with similar enhanced styling -->
        </div>
    </div>
</div>





<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();

        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        let isSidebarVisible = true;

        toggleButton.addEventListener('click', () => {
            isSidebarVisible = !isSidebarVisible;
            if (isSidebarVisible) {
                sidebar.classList.remove('hidden');
            } else {
                sidebar.classList.add('hidden');
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) { // md breakpoint
                sidebar.classList.remove('hidden');
                isSidebarVisible = true;
            }
        });
    });
</script>


<?php require_once "../views/partials/footer.php" ?>