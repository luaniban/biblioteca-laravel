
<div>
    <style>
        .loader-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 10px solid #555;
        border-top-color: #6a90f8;
        animation: loader-circle 1s linear infinite;
        }

        @keyframes loader-circle {
        0% {
            transform: rotate(0);
        }
        100% {
            transform: rotate(360deg);
        }
        }
    </style>
    @if($modal)


        <div class="fixed bottom-0 right-0 flex flex-col items-center justify-around h-[100%] bg-[#f1f1f1] w-52 z-[80]">
            <div class="absolute z-50 top-2 right-2">
                <x-ts-button icon="x-mark" class="rounded-full" wire:click="closeModal" color="none"></x-ts-button>
            </div>
                <div class="flex flex-col items-center w-full mt-8">
                    <div class="font-semibold text-center text-gray-400 text-md ">Feito por:</div>
                    <div class="text-lg font-semibold text-center text-gray-800">{{ $livro->nome_aluno}}</div>
                </div>

            <div id="card" class="flex flex-col items-center justify-center w-full px-4">
                <div class="w-full rounded-md h-42"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></div>
                <div class="w-full mt-4 text-lg font-semibold text-center text-gray-800 break-words">{{ $livro->name }}</div>
                <div class="w-full mt-2 overflow-auto text-center text-gray-600 break-words text-md max-h-56">{{ $livro->description }}</div>
            </div>
            <div class="mt-8">

            </div>
            <div class="absolute z-50 flex items-end justify-center w-full gap-2 bottom-1">
                @auth
                    @if(Auth::user()->id != 5)
                        <x-ts-button icon="pencil"  @click="$dispatch('edit-book', {id: {{ $livro->id }}})"></x-ts-button>
                    @endif
                @endauth
                <x-ts-button icon="eye" wire:click='visualizarLivro'>Visualizar</x-ts-button>
            </div>
                <div wire:loading>
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="loader-circle"></div>
                    </div>
                </div>
                <x-ts-toast/>

                <livewire:livro.edit/>
        </div>
    @endif






</div>
