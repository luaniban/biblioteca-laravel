
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
        <div class="fixed bottom-0 right-0 flex flex-col items-center justify-around h-[100%] bg-[#f1f1f1] w-52">
                <div class="flex flex-col items-center w-full mt-8">
                    <div class="font-semibold text-center text-gray-400 text-md ">Feito por:</div>
                    <div class="text-lg font-semibold text-center text-gray-800">{{ $livro->nome_aluno}}</div>
                </div>

            <div id="card" class="flex flex-col items-center justify-center w-full px-4">
                <div class="w-full rounded-md h-42"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></div>
                <div class="mt-4 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                <div class="mt-2 text-center text-gray-600 text-md">{{ $livro->description }}</div>
            </div>

                <button class="px-2 py-2 font-semibold text-white bg-blue-500 rounded-md hover:bg-blue-600" wire:click='visualizarLivro'>Visualizar</button>
                <div wire:loading>
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="loader-circle"></div>
                    </div>
                </div>
        </div>
    @endif






</div>
