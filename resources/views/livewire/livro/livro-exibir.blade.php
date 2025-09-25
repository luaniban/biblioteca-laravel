
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


        <div class="  flex flex-col items-center justify-around h-[100%] bg-[#eaf5ff] w-full py-4">

                <div class="flex flex-col items-center w-full mt-4">
                    <div class="font-semibold text-center text-gray-400 text-md ">Feito por:</div>
                    <div class="text-lg font-semibold text-center text-gray-800">{{ $livro->nome_aluno}}</div>
                </div>

            <div id="card" class="flex flex-col items-center justify-center w-full px-4">
                <img src="{{ asset('storage/capas/' . $livro->image_capa) }} " class="h-96">
                <div class="w-full mt-4 text-2xl font-semibold text-center text-gray-800 break-words">{{ $livro->name }}</div>
                <div class="w-full mt-2 overflow-auto text-center text-gray-600 break-words text-md max-h-56">{{ $livro->description }}</div>
            </div>


            <div class="flex flex-col justify-center gap-2 px-6 mt-4">
                @auth
                    @if(Auth::user()->id != 5 && $livro->escola_id == Auth::user()->escola_id)
                        <x-ts-button icon="pencil"  @click="$dispatch('edit-book', {id: {{ $livro->id }}})"></x-ts-button>
                    @endif
                @endauth
                <x-ts-button icon="eye" wire:click='visualizarLivro'>Visualizar</x-ts-button>
                <x-ts-button icon="arrow-down-tray" @click="$dispatch('baixar-book', {link: '{{ $livro->link }}'})"></x-ts-button>
            </div>
                <div wire:loading>
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="loader-circle"></div>
                    </div>
                </div>
                <x-ts-toast/>

                <livewire:livro.edit/>
                <livewire:livro.baixar-livro/>



        </div>
    @endif






</div>
