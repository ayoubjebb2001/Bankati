<?php require_once "../views/partials/header.php";

?>

<style>
    @keyframes slideIn {
        from {
            transform: translateY(20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .slide-in {
        animation: slideIn 0.3s ease-out;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-out;
    }

    .hover-scale {
        transition: transform 0.2s ease-out;
    }

    .hover-scale:hover {
        transform: scale(1.02);
    }
</style>




<div class="flex flex-wrap md:flex-nowrap ">
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
            <a href="/user/myAccounts" class="nav-link flex items-center w-full p-4 space-x-3  hover:bg-blue-600/30">
                <i data-lucide="credit-card" class="w-5 h-5"></i>
                <span>Mes comptes</span>
            </a>
            <a href="/user/virements" class="nav-link flex items-center w-full p-4 space-x-3  bg-blue-600/50 backdrop-blur">
                <i data-lucide="send" class="w-5 h-5"></i>
                <span>Virements</span>
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




    <!-- Enhanced Main Content -->
    <div class="flex-1 p-8 fade-in">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Effectuer un virement</h2>

        <!-- Enhanced Transfer Form -->
        <div class="bg-white p-8 rounded-xl shadow-lg hover-scale">
            <form class="space-y-6" id="transferForm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Compte à débiter</label>
                        <select id="first" name="first" class="w-full rounded-lg border-gray-200 p-3 transition-colors duration-200 focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="al">choose Compte à débiter</option>
                            <?php foreach ($accounts as $account): ?>
                                <?php
                                if ($account["account_status"] == "actif") {
                                    echo "<option value='" . $account["id"] . "'>";
                                    echo $account["id"];
                                    echo "</option>";
                                }
                                ?>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Bénéficiaire</label>
                        <select name="second" id="second" class="w-full rounded-lg border-gray-200 p-3 transition-colors duration-200 focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="all2">choose Bénéficiaire</option>
                            <?php foreach ($accounts as $account): ?>
                                <?php
                                if ($account["account_status"] == "actif") {
                                    echo "<option value='" . $account["id"] . "'>";
                                    echo $account["id"];
                                    echo "</option>";
                                }
                                ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Montant</label>
                    <div class="relative rounded-lg shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-gray-500">€</span>
                        </div>
                        <input
                            type="number"
                            min="0.01"
                            step="0.01"
                            class="pl-8 w-full rounded-lg border-gray-200 p-3 transition-colors duration-200 focus:border-blue-500 focus:ring focus:ring-blue-200"
                            placeholder="0.00" />
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Motif</label>
                    <input
                        type="text"
                        class="w-full rounded-lg border-gray-200 p-3 transition-colors duration-200 focus:border-blue-500 focus:ring focus:ring-blue-200"
                        placeholder="Motif du virement" />
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-500 text-white p-4 rounded-lg transition-all duration-200 hover:from-blue-700 hover:to-blue-600 focus:ring-4 focus:ring-blue-200 transform hover:-translate-y-0.5">
                    Valider le virement
                </button>
            </form>
        </div>

        <!-- Enhanced Recent Transfers -->
        <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden hover-scale">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-xl font-semibold text-gray-800">Derniers virements</h3>
            </div>
            <div class="divide-y divide-gray-100" id="recentTransfers">
                <!-- Transfer items will be added here by JavaScript -->
            </div>
        </div>

    </div>

    <script>
        let send = document.getElementById('first');
        let rcv = document.getElementById('second');

        send.addEventListener("change", function() {
            for (let option of rcv.options) {
                if (option.value === send.value) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            }
        });

        rcv.addEventListener("change", function() {
            for (let option of send.options) {
                if (option.value === rcv.value) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            }
        });
    </script>


    <?php require_once "../views/partials/footer.php" ?>