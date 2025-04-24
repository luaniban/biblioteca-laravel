<div>
    <button class="px-3 py-1 text-lg font-semibold text-white bg-blue-400 rounded-full hover:bg-blue-500" wire:click="store">Criar</button>

    @if($modal)
    <div class="fixed inset-0 flex items-center justify-center transition-all duration-300 ease-out bg-gray-500 bg-opacity-75" wire:click="closeModal">
        <!-- Modal -->
        <div class="w-1/2 p-6 bg-white rounded-lg" wire:click.stop>
            <h2 class="mb-6 text-2xl font-semibold">Adicionar Livro</h2>
            <form wire:submit.prevent="create">
            <div class="grid items-center justify-center w-full grid-cols-12 gap-4 mb-6">
                <div class="col-span-6">
                    <label for="name">Titulo do livro<span class="ml-1 text-red-600">*</span></label>
                    <input type="text" class="w-full border-gray-300" wire:model="name">
                </div>
                <div class="col-span-6">
                    <label for="name">Escola<span class="ml-1 text-red-600">*</span></label>
                    <input type="text" class="w-full border-gray-300" wire:model="escola_id">
                </div>
                <div  class="col-span-6">
                    <label for="name">Descrição<span class="ml-1 text-red-600">*</span></label>
                    <textarea type="text" class="w-full border-gray-300" wire:model="description"></textarea>
                </div>

                <div  class="col-span-6">
                    <label for="name">Upload do livro<span class="ml-1 text-red-600">*</span></label>
                    <input type="file" class="w-full border-gray-300 " wire:model="uploadLivro">
                </div>

            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 mr-2 text-white bg-blue-600 rounded-md cursor-pointer hover:bg-blue-700">
                    Salvar
                </button>
                <button wire:click="closeModal" class="px-4 py-2 text-white bg-red-600 rounded-md cursor-pointer hover:bg-red-700">
                    Fechar
                </button>
               
            </div>
        </form>
        </div>
    </div>



    @endif

</div>
