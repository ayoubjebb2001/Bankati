<?php require_once "../views/partials/header.php" ?>

<!-- <?php var_dump($users);
        // die();
        ?> -->

<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Sidebar -->
    <div class="w-full md:w-1/5 bg-gradient-to-b from-blue-800 to-blue-700 text-white shadow-xl" id="sidebar">
        <div class="p-8">
            <h1 class="text-2xl font-bold tracking-tight animate-fade-in">Ma Banque</h1>
        </div>
        <nav class="mt-6">
            <a href="index.html" class="nav-link flex items-center w-full p-4 space-x-3  hover:bg-blue-600/30">
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
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Numéro client</label>
                                    <input
                                        type="text"
                                        readonly
                                        value="<?= trim($user["id"] . $user["name"][0] . $user["name"][3] . $user["name"][7]) ?>"
                                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2" />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                                    <input
                                        type="text"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                        value="<?= $user["name"] ?>" />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <input
                                        type="email"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                        value="<?= $user["email"] ?>" />
                                </div>
                            </div>
                            <div class="flex justify-end pt-4">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
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
                        <form class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                                <input
                                    type="password"
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                    placeholder="••••••••" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                                <input
                                    type="password"
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                    placeholder="••••••••" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                                <input
                                    type="password"
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                    placeholder="••••••••" />
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Modifier le mot de passe
                                </button>
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