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
    if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
        // Rediriger vers la page de login
        window.location.href = '/logout';
    }
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
function toggleAddClientModal(isEdit = false,event) {
    const modal = document.getElementById('addClientModal');
    modal.classList.toggle('hidden');
    const form = document.getElementById('addClientForm');
    if(isEdit && event) {
        const button = event.currentTarget;
        const clientData = JSON.parse(button.dataset.client)
        document.getElementById('ModalTitle').innerText = 'Modifier le client';
        form.action = '/clients/edit';
        document.getElementById('AddClientButton').innerText = 'Confirmer';
        // fill the inputs from the client information
        form['num_client'].value = clientData.id;
        form['lastname'].value = clientData.name.split(' ')[0];
        form['firstname'].value = clientData.name.split(' ')[1] || '';
        form['email'].value = clientData.email;
        form['phone'].value = clientData.phone;
        form['address'].value = clientData.address;
        document.getElementById('account_config').hidden = true;
        
    } else {
        document.getElementById('ModalTitle').innerText = 'Ajouter un client';
        document.getElementById('addClientForm').action = '/clients/add';
        document.getElementById('AddClientButton').innerText = 'Ajouter';
        document.getElementById('account_config').hidden = false;
        form.reset();
    }
}

function submitAddClientForm() {
    const form = document.getElementById('addClientForm');
    if (form.checkValidity()) {
        // Traitement du formulaire ici
        alert('Client ajouté avec succès !');
        toggleAddClientModal();
        form.submit();
    } else {
        form.reportValidity();
    }

}