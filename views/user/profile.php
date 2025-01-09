<?php require_once "../views/partials/header.php";

// var_dump($_GET);
?>


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
            <a href="/user/myAccounts" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="credit-card" class="w-5 h-5"></i>
                <span>Mes comptes</span>
            </a>
            <a href="/user/virements" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="send" class="w-5 h-5"></i>
                <span>Virements</span>
            </a>
            <a href="/user/historique" class="nav-link flex items-center w-full p-4 space-x-3 hover:bg-blue-600/30">
                <i data-lucide="history" class="w-5 h-5"></i>
                <span>Historique</span>
            </a>
            <a href="/user/profile" class="nav-link flex items-center w-full p-4 space-x-3 bg-blue-600/50 backdrop-blur ">
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
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="flex-1 p-8">
        <h2 class="text-2xl font-bold text-gray-800">Mon Profil</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
            <!-- Informations Personnelles -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Informations Personnelles</h3>
                        <form class="space-y-6" action="profile/modifyprofile" method="post">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Numéro client</label>
                                    <input
                                        type="text"
                                        readonly
                                        value="<?= $user["id"] . $user["name"][0] . $user["name"][1] ?>"
                                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2" />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                                    <input
                                        type="text"
                                        name="name"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                        value="<?= $user["name"] ?>" />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">phone</label>
                                    <input
                                        type="tel"
                                        name="phone"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                        value="<?= $user["phone"] ?>" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Address</label>
                                    <input
                                        type="text"
                                        name="address"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                        value="<?= $user["address"] ?>" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <input
                                        type="email"
                                        name="email"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                        value="<?= $user["email"] ?>" />
                                </div>
                            </div>
                            <div class="flex justify-end pt-4">
                                <button type="submit" name="info" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Sauvegarder les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sécurité -->
                <div class="bg-white rounded-lg shadow mt-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Sécurité</h3>
                        <form class="space-y-6" action="profile/profilePSW" method="post">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                                <input
                                    type="password"
                                    name="psw1"
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                    placeholder="••••••••" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                                <input
                                    type="password"
                                    name="psw2"
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                    placeholder="••••••••" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                                <input
                                    type="password"
                                    name="psw3"
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                    placeholder="••••••••" />
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit" name="psw" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Modifier le mot de passe
                                </button>
                            </div>
                            <div class="">
                                <?php if (isset($_GET["wrong_password"])) {
                                    echo "
                                    <div style='
                                        color: #fff;
                                        background-color: #e74c3c;
                                        border: 1px solid #c0392b;
                                        border-radius: 5px;
                                        padding: 10px 15px;
                                        margin: 10px 0;
                                        font-family: Arial, sans-serif;
                                        font-size: 14px;
                                        text-align: center;
                                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                    '>
                                        <strong>Error:</strong> The password you entered is incorrect. Please try again.
                                    </div>";
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
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