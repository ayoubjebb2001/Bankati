<?php require_once 'partials/header.php'; ?>
<div class="flex min-h-screen relative">
<?php require_once 'partials/sidebar.php'; ?>
<!-- Main Content -->
<div class="flex-1 flex flex-col">
    <!-- Top Navigation -->
    <div class="bg-white shadow">
        <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
            <div class="flex items-center space-x-4">
                <button class="p-2 text-gray-400 hover:text-gray-600">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </button>
                <button class="p-2 text-gray-400 hover:text-gray-600 relative">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
            </div>
        </div>
    </div>
    <!-- Dashboard Content avec Responsive -->
    <div class="p-4 sm:p-6 lg:p-8 flex-grow">
        <!-- Statistiques -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- ... Cards statistiques existantes ... -->
        </div>

        <!-- Grilles responsive -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mt-6">
            <!-- ... Rest of your content ... -->
        </div>
    </div>
</div>
</div>

<!-- Overlay pour mobile -->
<div
    id="sidebarOverlay"
    onclick="toggleSidebar()"
    class="fixed inset-0 bg-black bg-opacity-50 lg:hidden hidden z-20">
</div>
<?php require_once 'partials/footer.php'; ?>