<?php require_once "../partials/header.php" ?>


<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Sidebar -->
    <div class="w-full md:w-1/5 bg-gradient-to-b from-blue-800 to-blue-700 text-white shadow-xl" id="sidebar">
        <div class="p-8">
            <h1 class="text-2xl font-bold tracking-tight animate-fade-in">Ma Banque</h1>
        </div>
        <nav class="mt-6">
            <a href="index.html" class="nav-link flex items-center w-full p-4 space-x-3 bg-blue-600/50 backdrop-blur">
                <i data-lucide="wallet" class="w-5 h-5"></i>
                <span>Tableau de bord</span>
            </a>
            <a href="compte.html" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
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
            <a href="profeil.html" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="user" class="w-5 h-5"></i>
                <span>Profil</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col p-8">
        <!-- Header -->
        <header class="flex items-center justify-between mb-8 animate-fade-in">
            <h2 class="text-3xl font-bold text-gray-800">Tableau de bord</h2>
            <button class="md:hidden p-2 text-blue-800 hover:text-blue-600 focus:outline-none" id="toggleSidebar">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </header>

        <!-- Account Summary Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="card bg-white p-6 rounded-xl shadow-sm animate-slide-in" style="animation-delay: 0.1s">
                <div class="flex items-center space-x-3 mb-4">
                    <i data-lucide="wallet" class="w-6 h-6 text-blue-600"></i>
                    <h3 class="text-lg font-semibold text-gray-700">Compte Courant</h3>
                </div>
                <p class="text-4xl font-bold text-gray-900 mb-2">&euro;2,450.50</p>
                <p class="text-sm text-gray-500">N° FR76 1234 5678 9012</p>
            </div>

            <div class="card bg-white p-6 rounded-xl shadow-sm animate-slide-in" style="animation-delay: 0.2s">
                <div class="flex items-center space-x-3 mb-4">
                    <i data-lucide="piggy-bank" class="w-6 h-6 text-green-600"></i>
                    <h3 class="text-lg font-semibold text-gray-700">Compte Épargne</h3>
                </div>
                <p class="text-4xl font-bold text-gray-900 mb-2">&euro;15,750.20</p>
                <p class="text-sm text-gray-500">N° FR76 9876 5432 1098</p>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8 animate-slide-in" style="animation-delay: 0.3s">
            <button class="action-button flex items-center justify-center space-x-2 p-4 bg-blue-600 text-white rounded-lg">
                <i data-lucide="send" class="w-5 h-5"></i>
                <span>Nouveau virement</span>
            </button>
            <button class="action-button flex items-center justify-center space-x-2 p-4 bg-green-600 text-white rounded-lg">
                <i data-lucide="plus-circle" class="w-5 h-5"></i>
                <span>Alimenter compte</span>
            </button>
            <button class="action-button flex items-center justify-center space-x-2 p-4 bg-purple-600 text-white rounded-lg">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span>Gérer bénéficiaires</span>
            </button>
        </div>

        <!-- Recent Transactions Section -->
        <div class="bg-white rounded-xl shadow-sm mt-8 animate-slide-in" style="animation-delay: 0.4s">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">Transactions récentes</h3>
                    <a href="historique.html" class="text-blue-600 hover:text-blue-700 text-sm">Voir tout</a>
                </div>
                <div class="space-y-4">
                    <div class="transaction-item flex items-center justify-between p-4 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-red-100 rounded-full">
                                <i data-lucide="send" class="w-5 h-5 text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Virement à John Doe</p>
                                <p class="text-sm text-gray-500">12 janvier 2025</p>
                            </div>
                        </div>
                        <p class="text-red-600 font-medium">-&euro;125.00</p>
                    </div>
                    <div class="transaction-item flex items-center justify-between p-4 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-green-100 rounded-full">
                                <i data-lucide="download" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Virement reçu de Marie Martin</p>
                                <p class="text-sm text-gray-500">11 janvier 2025</p>
                            </div>
                        </div>
                        <p class="text-green-600 font-medium">+&euro;350.00</p>
                    </div>
                    <div class="transaction-item flex items-center justify-between p-4 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-red-100 rounded-full">
                                <i data-lucide="credit-card" class="w-5 h-5 text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Paiement Carte Bancaire</p>
                                <p class="text-sm text-gray-500">10 janvier 2025</p>
                            </div>
                        </div>
                        <p class="text-red-600 font-medium">-&euro;42.50</p>
                    </div>
                </div>
            </div>
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



<?php require_once "../partials/footer.php" ?>