<div>
    @if($modal)
    <div class="fixed inset-0 flex items-center justify-center transition-all duration-300 ease-out bg-gray-500 bg-opacity-75 z-[80]" wire:click="closeModal">
        <!-- Modal -->
        <div class="w-1/2 p-6 bg-white rounded-lg" wire:click.stop>
            <div class="flex flex-col items-center justify-center w-full">
                <h1 class="text-4xl font-bold text-red-500">AVISO</h1>
                <span class="w-4/5 p-2 mt-4 text-xl text-center bg-gray-200 rounded-md">Você está deletando o livro {{ $livro->name }} que o aluno {{ $livro->nome_aluno }} criou</span>
            </div>

            <hr class="w-full mt-6 mb-4">
            <div class="flex justify-end">
                <button wire:click="delete" type="submit" class="px-4 py-2 mr-2 text-white bg-red-600 rounded-md shadow-lg cursor-pointer hover:bg-red-700">
                    Deletar
                </button>
                <button wire:click="closeModal" class="px-4 py-2 text-white bg-gray-900 rounded-md shadow-lg cursor-pointer hover:bg-gray-900">
                    Fechar
                </button>

            </div>
        </div>
    </div>

    @endif

</div>
