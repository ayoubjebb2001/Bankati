
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
        "userId": form['name'].options[form['name'].selectedIndex],
        "account": form['account_type'].value
    }
    if (form.checkValidity()) {
        Swal.fire({
            icon: 'question',
            title: 'Do you want to Confim the Action?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            preConfirm: async () => {
                try {
                    const fetchURL = "http://localhost:8000/accounts/add";
                    // Create the headers
                    const headers = {
                        'Content-Type': 'application/json',
                    };

                    // Create the POST body
                    const body = JSON.stringify({
                        userID: data.userId.value,
                        accountType: data.account,
                    });
                    const response = await fetch(fetchURL, { method: 'POST', headers, body });
                    if (!response.ok) {
                        return Swal.showValidationMessage(`
                          ${JSON.stringify(await response.json())}
                        `);
                    }
                    return response.json();
                } catch (error) {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                }

            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result, response) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Hold on',
                    didOpen: () => { Swal.showLoading(); },
                    timer: 2000
                }).then(() => {
                    Swal.fire({
                        title: "Parfait!",
                        html: "Compte <span id = 'account' class=\"px-5 inline-flex leading-5 font-semibold rounded-lg dark:bg-sky-500 dark:text-white-800\"> </span> Configuré au client <b class=\"text-sky-500 dark:text-sky-400\"> </b>",
                        icon: "success",
                        didOpen: () => {
                            Swal.getPopup().querySelector("span#account").textContent = `${data.userID.dataset.client}`;
                            Swal.getPopup().querySelector("b").textContent = `${data.account}`;
                        },
                        showConfirmButton: true
                    })
                });

                window.location.reload(true);
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

// Fonction pour afficher les clients dans le select options
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
const renderSelect = (clients) => {
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
        renderSelect(clients);
        for (let index = 0; index < clients.length; index++) {
            form[0].options[index].setAttribute("data-client", clients[index].name);

        }

    })();

}, {
    once: true
});


// Dynamic filtering With Event delegation
// Add event listeners for all filter inputs
document.getElementById("filter").addEventListener("input", async (event) => {
    // Get current filter values
    const balance = document.querySelector("select[name='filter_account_balance']").value;
    const status = document.querySelector("select[name='filter_account_status']").value; 
    const type = document.querySelector("select[name='filter_account_type']").value;
    const account = document.querySelector("input[name='filter_account']").value;

    try {
        // Get filtered data
        const accounts = await filterClients(balance, status, type, account);
        // Update table with new data
        document.querySelector('#table').innerHTML = renderTable(accounts);
        // Reinitialize icons
        lucide.createIcons();
    } catch (error) {
        console.error('Error filtering accounts:', error);
    }
});

// Function to fetch filtered accounts from server
async function filterClients(balance = 'all', status = 'all', type = 'all', account = '') {
    try {
        const response = await fetch('http://localhost:8000/accounts/filter', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ balance, status, type, account })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

// Function to render the accounts table
function renderTable(accounts) {
    if (!accounts || accounts.length === 0) {
        
    }

    return accounts.map(account => `
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">${account.account_id}</div>
                <div class="text-sm text-gray-500">#ACC-${account.account_id.toString().padStart(3, '0')}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                        <img src="https://avatar.iran.liara.run/public/${account.account_id}" 
                             alt="" class="h-10 w-10 rounded-full">
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">${account.name}</div>
                        <div class="text-sm text-gray-500">${account.email}</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Compte ${account.account_type}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">${account.balance}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                ${getStatusBadge(account.account_status)}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-500">${account.last_activity?.activity || 'No activity'}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex space-x-2">
                    <button class="text-blue-600 hover:text-blue-900">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                    </button>
                    <button class="text-gray-600 hover:text-gray-900">
                        <i data-lucide="edit" class="w-5 h-5"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-900">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

// Helper function to generate status badge HTML
function getStatusBadge(status) {
    const badges = {
        'actif': 'bg-green-100 text-green-800',
        'bloqué': 'bg-red-100 text-red-800',
        'en attente': 'bg-yellow-100 text-yellow-800'
    };

    const className = badges[status] || 'bg-gray-100 text-gray-800';
    return `
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${className}">
            ${status.charAt(0).toUpperCase() + status.slice(1)}
        </span>
    `;
}
