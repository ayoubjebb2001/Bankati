
// Accounts functions 

// Fonction pour afficher/masquer le modal
function toggleAccountActionsModal() {
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
    if (form.checkValidity()) {
        // Traitement du formulaire ici
        alert('Compte créé avec succès !');
        toggleAccountActionsModal();
    } else {
        form.reportValidity();
    }
}

async function getClients() {
    try {
        const response = await fetch("http://localhost:8000/fetchClients");
        console.log(response);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
    } catch (error) {
        console.error(error.message);
    }
}

const form = document.getElementById("accountForm");

form[0].addEventListener("click", () => {
    getClients();
})