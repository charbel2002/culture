

    <section id="confirm-box" class="fixed h-screen bg-gray-600 bg-opacity-50 top-0 bottom-0 left-0 right-0 flex justify-center ease-in-out" style="display: none;">

        <article class="bg-white h-72 flex items-center justify-center flex-col mt-14 rounded">

            <div class="text-5xl text-red-600">
                <i class="fas fa-shield-alt"></i>
            </div>

            <div class="w-9/12 text-lg font-extrabold text-center">
                Cette action est irréversible, voulez vous poursuivre .
            </div>

            <div class="my-5">
                <button id="cancel-operation" class="p-2 bg-red-700 text-white rounded text-sm font-extrabold"> <i class="fas fa-times"></i> <span>Annuler</span> </button>
                <button id="approve-operation" class="p-2 bg-green-800 text-white rounded text-sm font-extrabold"> <i class="fas fa-check"></i> <span>Poursuivre</span> </button>
            </div>

        </article>

    </section>
