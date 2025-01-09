const accountConfig = document.getElementById('addClientForm').lastElementChild;
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
function toggleAddClientModal(isEdit = false, event) {
    const modal = document.getElementById('addClientModal');
    modal.classList.toggle('hidden');
    const form = document.getElementById('addClientForm');
    if (isEdit && event) {
        const button = event.currentTarget;
        const clientData = JSON.parse(button.dataset.client)
        document.getElementById('ModalTitle').innerText = 'Modifier le client';
        form.setAttribute("action","/clients/edit")
        document.getElementById('AddClientButton').innerText = 'Confirmer';

        document.getElementById('AddClientButton').removeEventListener("click", submitAddClientForm);
        document.getElementById('AddClientButton').addEventListener("click", (event)=>submitEditClientForm(event));
        // fill the inputs from the client information
        let input_id_hidden = document.createElement("input");
        input_id_hidden.setAttribute("type", "text");
        input_id_hidden.setAttribute("value", clientData.id);
        input_id_hidden.setAttribute("name", "id");
        input_id_hidden.hidden = true;
        form['lastname'].before(input_id_hidden);
        form['num_client'].value = clientData.num;
        form['lastname'].value = clientData.name.split(' ')[0];
        form['firstname'].value = clientData.name.split(' ')[1] || '';
        form['email'].value = clientData.email;
        form['phone'].value = clientData.phone;
        form['address'].value = clientData.address;
        form.removeChild(accountConfig);

    } else {
        if (form.lastElementChild != accountConfig) {
            form.append(accountConfig);
        }
        document.getElementById('AddClientButton').removeEventListener("click", submitEditClientForm);
        document.getElementById('AddClientButton').addEventListener("click", submitAddClientForm);
        document.getElementById('ModalTitle').innerText = 'Ajouter un client';
        document.getElementById('addClientForm').setAttribute("action", '/clients/add');
        document.getElementById('AddClientButton').innerText = 'Ajouter';
        form.reset();
    }
}

function submitAddClientForm() {
    const form = document.getElementById('addClientForm');
    if (form.checkValidity()) {
        Swal.fire({
            title: "Parfait!",
            text: "Client Ajouté",
            icon: "success",
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
        });
        form.submit();
        toggleAddClientModal();
    } else {
        form.reportValidity();
    }

}

function submitEditClientForm(event) {
    const form = document.getElementById('addClientForm');
    Swal.fire({
        title: "Parfait!",
        text: "Client Modifié",
        icon: "success",
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false
    });
    form.submit();
    toggleAddClientModal(true,event);
}

function lockClient(event){
    const client_id = JSON.parse(event.currentTarget.dataset.client).id;
    fetch("http://localhost:8000/clients/lock",
    {
        method: "POST",
        headers : {
            "Content-Type" : "application/json",
        },
        body : JSON.stringify({
            id : client_id
        }),
    }
    );
}

document.addEventListener("DOMContentLoaded",()=>{
    fetch("http://localhost:8000/clients").then( (response)=>{
        if(response.status == 201){
            Swal.fire({
                title: "Parfait!",
                text: "Client Verrouillé",
                icon: "success",
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        }
    } )

})