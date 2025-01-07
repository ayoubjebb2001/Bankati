<?php require_once "../views/partials/header.php";

?>


<div class="flex-1 p-8 space-y-6">
        <div class="max-w-2xl mx-auto">
          <h2 class="text-3xl font-bold text-gray-800 mb-8">Dépôt d'argent</h2>

          <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 space-y-6">
              <div class="border-b border-gray-200 pb-6">
                <h3 class="text-xl font-semibold text-gray-800">
                  Déposer de l'argent
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                  Veuillez saisir le montant que vous souhaitez déposer sur
                  votre compte
                </p>
              </div>

              <form id="addFundsForm" class="space-y-6">
                <div class="space-y-4">
                  <div>
                    <label
                      for="amount"
                      class="block text-sm font-medium text-gray-700"
                      >Montant à déposer</label
                    >
                    <div class="mt-1 relative rounded-md shadow-sm">
                      <div
                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                      >
                        <span class="text-gray-500 sm:text-sm">€</span>
                      </div>
                      <input
                        type="number"
                        name="amount"
                        id="amount"
                        class="block w-full pl-7 pr-12 py-3 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        placeholder="0.00"
                        required
                        min="0.01"
                        step="0.01"
                      />
                    </div>
                  </div>

                  <div>
                    <label
                      for="paymentMethod"
                      class="block text-sm font-medium text-gray-700"
                      >Mode de dépôt</label
                    >
                    <select
                      id="paymentMethod"
                      name="paymentMethod"
                      class="mt-1 block w-full py-3 px-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    >
                      <option value="cash">Espèces</option>
                      <option value="check">Chèque</option>
                      <option value="card">Carte bancaire</option>
                    </select>
                  </div>

                  <div>
                    <label
                      for="description"
                      class="block text-sm font-medium text-gray-700"
                      >Motif du dépôt (optionnel)</label
                    >
                    <textarea
                      id="description"
                      name="description"
                      rows="3"
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Ajoutez une note pour ce dépôt"
                    ></textarea>
                  </div>
                </div>

                <div class="bg-gray-50 -mx-6 -mb-6 px-6 py-4">
                  <div class="flex justify-end space-x-4">
                    <button
                      type="button"
                      onclick="window.history.back()"
                      class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                      Annuler
                    </button>
                    <button
                      type="submit"
                      class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                      Confirmer le dépôt
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        lucide.createIcons();

        const form = document.getElementById("addFundsForm");

        form.addEventListener("submit", (e) => {
          e.preventDefault();

          const amount = document.getElementById("amount").value;
          const paymentMethod = document.getElementById("paymentMethod").value;
          const description = document.getElementById("description").value;

          // Show success message
          alert(`Dépôt de ${amount}€ effectué avec succès!`);

          // Redirect back to accounts page
          window.location.href = "/user/myAccounts";
        });
      });
    </script>

    
<?php require_once "../views/partials/footer.php" ?>