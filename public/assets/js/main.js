
lucide.createIcons();
// Toggle Sidebar Mobile
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

// Toggle Profile Menu
function toggleProfileMenu() {
    const menu = document.getElementById('profileMenu');
    const chevron = document.getElementById('profileChevron');

    menu.classList.toggle('hidden');
    chevron.classList.toggle('rotate-180');
}

// Fonction de déconnexion
function logout() {
    // Afficher un modal de confirmation
    Swal.fire({
        title: "Are you sure?",
        text: "You are going to log out!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Log out!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("/").then(() => {

            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Keep Up",
                icon: "success"
            });
        }

    })
}

// Fermer le menu profil si on clique ailleurs
document.addEventListener('click', function (event) {
    const menu = document.getElementById('profileMenu');
    const profileButton = event.target.closest('button');

    if (!profileButton && !menu.classList.contains('hidden')) {
        menu.classList.add('hidden');
        document.getElementById('profileChevron').classList.remove('rotate-180');
    }
});

