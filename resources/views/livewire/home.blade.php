<div class="h-screen overflow-y-auto">
    <style>
        .scrollbar-thin-custom::-webkit-scrollbar {
        width: 6px;
        }
        .scrollbar-thin-custom::-webkit-scrollbar-track {
        background: #f1f1f1;
        }
        .scrollbar-thin-custom::-webkit-scrollbar-thumb {
        background-color: #9099e7;
        border-radius: 10px;
        }
        .scrollbar-thin-custom::-webkit-scrollbar-thumb:hover {
        background:  #6973cf;
        }


        .wood-text {

        font-weight: bold;
        background: url('./img/texturaTexto.png') no-repeat center center;
        background-size: cover;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;

        text-shadow:
        -1px -1px 0 rgba(255, 255, 255, 0.1),
        1px 1px 2px rgba(0, 0, 0, 0.6),
        2px 2px 4px rgba(0, 0, 0, 0.5);
        }

    </style>
    <livewire:livro.livro-exibir/>
    <div class="flex justify-center ">
        <section class="hidden sm:w-[15%]  bg-[#6293ee] sm:flex flex-col  items-center space-y-8 px-4 pb-4 fixed top-0 left-0 bottom-0">
            <img src="./img/logo-prefeitura.png" alt="Logo da prefeitura">
            <hr class="w-full">
           <div class="flex flex-col items-center w-full px-4 py-4 bg-white rounded-md">
               <div class="flex items-center gap-2 mb-4">

                <x-ts-input placeholder="Pesquisar..." wire:model.live="pesquisarEscola" icon="magnifying-glass" text="sm" ></x-ts-input>

               </div>
               <x-ts-select.styled    placeholder="Filtrar por..."  wire:model.live="filtroDasEscolas" :options="[
                ['label' => 'A-Z', 'value' => 'AZ'],
                ['label' => 'Z-A', 'value' => 'ZA'],
            ]" />


                <div class="w-full mt-4 ml-12 mr-8 overflow-y-auto scrollbar-thin-custom h-[40vh] ">
                    <div class="max-h-[50vh] flex flex-col gap-5 mt-4 ">
                        @foreach ($escolaAll as $escolaa)
                            <p wire:click="visualizarEscolaEspecifica({{ $escolaa->id }})"  class="text-[#084E80] font-semibold hover:cursor-pointer px-2 py-1 hover:bg-gray-100 text-sm text-center">{{ $escolaa->name }}</p>
                            <hr class="w-[85%]">
                        @endforeach
                    </div>
                </div>

           </div>

            @auth
            <nav class="flex flex-col items-center justify-end w-full h-full gap-2 px-2">

                        <form method="POST" action="{{ route('logout') }}" x-data class="px-2 py-1 text-blue-500 bg-white rounded-lg hover:font-semibold hover:bg-gray-20">
                            @csrf

                            <a href="{{ route('logout') }}"
                                     @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
            </nav>
            @endauth

        </section>
        <div class="h-full hidden sm:w-[15%] sm:block">

        </div>
        <div class="flex flex-col sm:w-full ">

            <main class="w-full h-full sm:p-8 ">

                <h1 class="flex justify-center w-full text-3xl font-bold text-white sm:block">{{ $tituloDaHome }}</h1>


                <div class="w-full p-8 ">
                    <div class="flex items-center justify-center w-full gap-8 sm:justify-start ">
                        <div class="flex items-center gap-2 ">

                            <x-ts-input placeholder="Pesquisar Obras..." wire:model.live="pesquisarLivro" icon="magnifying-glass" class="" ></x-ts-input>

                        </div>
                        <x-ts-select.styled   placeholder="Filtrar por..."  wire:model.live="filtroDosLivros" :options="[
                            ['label' => 'A-Z', 'value' => 'AZ'],
                            ['label' => 'Z-A', 'value' => 'ZA'],
                        ]" />

                        @auth
                        <div class="hidden gap-8 sm:flex">
                            @if(Auth::user()->id != 5)
                                <livewire:livro.create/>
                            @endif
                            @if(Auth::user()->id == 5)
                                <x-ts-button icon="users" color="black" @click="$dispatch('open-table-user')">Tabela de Usuários</x-ts-button>

                            @endif
                        </div>
                        @endauth






                    </div>
                        <div class="flex flex-col w-full gap-12 mt-8">

                            @php
                                use App\Models\Livro;



                            @endphp


                            @foreach ($escolaAllList as $escola)

                            @php


                               if ($escolaSelecionadaId == null) {
                                if ($pesquisarLivro != null) {
                                    $livrosAll = Livro::where('escola_id', $escola->id)->where('name', 'like', '%' . $pesquisarLivro . '%')->get();
                                }
                                elseif ($ordem == '') {
                                    $livrosAll = Livro::where('escola_id', $escola->id)->get();
                                }
                                elseif ($ordem == 'AZ') {
                                    $livrosAll = Livro::where('escola_id', $escola->id)->orderBy('name', 'asc')->get();
                                }
                                elseif ($ordem == 'ZA') {
                                    $livrosAll = Livro::where('escola_id', $escola->id)->orderBy('name', 'desc')->get();
                                }

                               }
                            @endphp
                                @if( $livrosAll->isNotEmpty() )
                                <div class="w-full ">

                                <div class="py-2 px-4 text-3xl font-semibold text-white  bg-[url('./img/fundoDoTitulo.png')] bg-cover bg-center bg-no-repeat sm:w-[70vw] w-[100vw]"><div class=" wood-text">{{$escola->name }}</div></div>

                                    <div class="flex  sm:px-4 pt-12  sm:w-[70vw]   relative bg-[url('./img/prateleiraTeste.png')] bg-cover bg-center bg-no-repeat w-[100vw]">
                                        <div class="scale-75 translate-x-14 swiper-button-next swiper_{{ $escola->id }}_next text-white hidden sm:block"></div>
                                        <div class="scale-75 swiper-button-prev -translate-x-14 swiper_{{ $escola->id }}_prev text-white hidden sm:block"></div>

                                        <div class="w-[90%] swiper swiper_{{ $escola->id }}">
                                            <div class=" swiper-wrapper">


                                                @foreach ( $livrosAll as $livro )

                                                <div id="card" class="flex flex-col items-center justify-center w-48 swiper-slide h-60 bg-gradient-to-t from-gray-50 to-gray-400">
                                                    @auth
                                                        @if(Auth::user()->id != 5)

                                                            <div class="fixed top-0 flex items-start justify-end w-full">
                                                                @if(Auth::user()->escola_id == $escola->id)
                                                                    <x-ts-button color="red" icon="trash" class="w-full h-8 text-sm rounded-none" @click="$dispatch('deleteLivro', {id: {{ $livro->id }}})">Excluir</x-ts-button>
                                                                @endif

                                                            </div>
                                                        @endif
                                                    @endauth
                                                    <div >
                                                        <button class="rounded-md shadow-xl shadow-slate-500 w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                    </div>
                                                    <div class="w-full h-full pb-2">
                                                        <div class="w-full mt-6 text-lg font-semibold text-center text-gray-800 break-words ">{{ $livro->name }}</div>
                                                    </div>

                                                </div>




                                                @endforeach
                                            </div>

                                        </div>


                                    </div>
                                    <div class="h-10   bg-[url('./img/fundoDoTitulo.png')] bg-cover bg-center bg-no-repeat   shadow-black shadow-lg sm:w-[70vw] w-[100vw]"></div>
                                </div>
                                @endif

                            @endforeach

                        {{-- @foreach ($livrosAll as $livro)
                        <div id="card" class="flex flex-col items-center justify-center w-40 shadow-lg h-60 shadow-slate-600 bg-gradient-to-t from-gray-300 to-gray-50">
                            <div wire:click="closeUser">
                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                            </div>
                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                        </div>
                        @endforeach --}}




                    </div>


                </div>
                <x-ts-toast/>

                <livewire:livro.delete/>
                <livewire:user.table>
            @auth
                @if (Hash::check('Atividade1!', Auth::user()->password))
                    <livewire:user.new-password>
                @endif
            @endauth

            </main>


            <script>


              </script>


</div>
