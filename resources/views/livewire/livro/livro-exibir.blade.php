
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
        <div class="fixed top-0 right-0 flex flex-col items-center justify-around h-full bg-gray-200 w-52">
            <div id="card" class="flex flex-col items-center justify-center w-full mt">
                <div class="bg-green-700 rounded-md w-28 h-36"></div>
                <div class="mt-2 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                <div class="mt-2 text-lg font-semibold text-gray-800 ">{{ $livro->description }}</div>
            </div>

                <button class="px-2 py-1 font-semibold text-white bg-blue-500 rounded-full hover:bg-blue-600" wire:click='visualizarLivro'>Visualizar</button>
                <div wire:loading>
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="loader-circle"></div>
                    </div>
                </div>
        </div>
    @endif






</div>
