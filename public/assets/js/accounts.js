
// Accounts functions 

// Fonction pour afficher/masquer le modal
function toggleAccountActionsModal(isEdit = false) {
    const modal = document.getElementById('accountActionsModal');
    modal.classList.toggle('hidden');

}

// Fonction pour gérer l'affichage des champs selon le type de compte
function toggleSavingsFields(accountType) {
    const decouvertField = document.getElementById('decouvertField');
    const tauxInteretField = document.getElementById('tauxInteretField');

    if (accountType === 'epargne') {
        decouvertField.classList.add('hidden');
        tauxInteretField.classList.remove('hidden');
    } else {
        decouvertField.classList.remove('hidden');
        tauxInteretField.classList.add('hidden');
    }
}

// Fonction pour soumettre le formulaire
function submitAccountForm() {
    const form = document.getElementById('accountForm');
    const data = {
        "name": form['client_name_form'].options[form['client_name_form'].selectedIndex].getAttribute('data-client'),
        "account": form['account_type_form'].value
    }
    if (form.checkValidity()) {
        Swal.fire({
            icon : 'question',
            title: 'Do you want to Confim the Action?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
          }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Parfait!",
                    html: "Compte <span id = 'account' class=\"px-5 inline-flex leading-5 font-semibold rounded-lg dark:bg-sky-500 dark:text-white-800\"> </span> Configuré au client <b class=\"text-sky-500 dark:text-sky-400\"> </b>",
                    icon: "success",
                    didOpen: () => {
                        Swal.getPopup().querySelector("span#account").textContent = `${data.account}`;
                        Swal.getPopup().querySelector("b").textContent = `${data.name}`;
                    },
                    showConfirmButton: true
                }).then(()=>{
                    form.submit();
                });
            } else if (result.isDenied) {
              Swal.fire('Changes are not saved', '', 'info')
            }
          })

        // form.submit();
        toggleAccountActionsModal();
    } else {
        form.reportValidity();
    }
}

async function getClients() {
    try {
        const response = await fetch("http://localhost:8000/fetchClients");
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        return await response.json();
    } catch (error) {
        console.error(error.message);
    }
}

const form = document.getElementById("accountForm");
const render = (clients) => {
    return clients.map(({ id, name }) =>
        form[0].add(new Option(`${name} - #CLT${(id).toString().padStart(4, '0')}`, `${(id).toString()}`))
    )
};



form[0].addEventListener("click", () => {
    // Remove existant options 
    while (form[0].options.length > 0) {
        form[0].remove(0);
    }
    (async () => {
        const clients = await getClients();
        render(clients);
        for (let index = 0; index < clients.length; index++) {
            form[0].options[index].setAttribute("data-client", clients[index].name);

        }

    })();

}, {
    once: true
})