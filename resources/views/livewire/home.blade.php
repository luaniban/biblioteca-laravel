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

    </style>
    <livewire:livro.livro-exibir/>
    <div class="flex">
        <section class="w-44 sm:w-56 bg-[#6293ee] flex flex-col  items-center space-y-8 px-4 pb-4 fixed top-0 left-0 bottom-0">
            <img src="./img/logo-prefeitura.png" alt="Logo da prefeitura">
            <hr class="w-full">
           <div class="flex flex-col items-center w-full h-full px-4 py-4 bg-white rounded-md">
               <div class="flex items-center gap-2 ">
                <img src="./img/search.png" alt="" class="w-4 h-4">
                <input wire:model.live="pesquisarEscola" class="bg-[#EAF4FF] text-[#A3B2D8]  w-full py-1 rounded-md text-center border-gray-300 focus:outline-none text-sm" placeholder="Pesquisar Escolas..." >
               </div>
               <select wire:model.live="filtroDasEscolas" class="bg-[#084E80] text-white font-semibold  py-1  px-2 rounded-md text-center mt-4 text-sm">
                   <option value="">Filtrar</option>
                   <option value="AZ" >A-Z</option>
                   <option value="ZA" >Z-A</option>
               </select>


                <div class="w-full mt-4 ml-12 mr-8 overflow-y-auto scrollbar-thin-custom h-[40vh] ">
                    <div class="max-h-[50vh] flex flex-col gap-5 mt-4 ">
                        @foreach ($escolaAll as $escolaa)
                            <p wire:click="visualizarEscolaEspecifica({{ $escolaa->id }})"  class="text-[#084E80] font-semibold hover:cursor-pointer px-2 py-1 hover:bg-gray-100 text-sm text-center">{{ $escolaa->name }}</p>
                            <hr class="w-[85%]">
                        @endforeach
                    </div>
                </div>

           </div>


            <nav class="flex items-center justify-center w-full h-full px-2 ">

                        <form method="POST" action="{{ route('logout') }}" x-data class="px-2 py-1 text-blue-500 bg-white rounded-lg hover:font-semibold hover:bg-gray-20">
                            @csrf

                            <a href="{{ route('logout') }}"
                                     @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>

            </nav>

        </section>
        <div class="h-full w-60">

        </div>
        <div class="flex flex-col w-full">

            <main class="w-full h-full p-8 ">

                    <h1 class="text-2xl font-bold text-white ">{{ $tituloDaHome }}</h1>


                <div class="w-full p-8 ">
                    <div class="flex items-center w-full gap-8 ">
                        <div class="flex items-center gap-2 ">
                            <img src="./img/search.png" alt="" class="w-5 h-5">
                            <input wire:model.live="pesquisarLivro" class="bg-[#EAF4FF] text-[#A3B2D8]  px-2 py-1 rounded-md  border-gray-300 focus:outline-none focus:border" placeholder="Pesquisar Obras... "></input>
                        </div>

                        <select  wire:model.live="filtroDosLivros" class="bg-[#084E80] text-white font-semibold py-1 px-2 rounded-md text-center">
                            <option value="">Filtrar</option>
                            <option value="AZ">A-Z</option>
                            <option value="ZA">Z-A</option>
                        </select>

                        <livewire:livro.create/>


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

                                <div class="py-2 px-4 text-2xl font-semibold text-white  bg-[url('./img/fundoDoTitulo.png')] bg-cover bg-center bg-no-repeat w-[70vw]"><div>{{$escola->name }}</div></div>

                                    <div class="flex px-4 pt-12   w-[70vw]   relative bg-[url('./img/prateleiraTeste.png')] bg-cover bg-center bg-no-repeat ">
                                        <div class="scale-75 translate-x-14 swiper-button-next swiper_{{ $escola->id }}_next text-white "></div>
                                        <div class="scale-75 swiper-button-prev -translate-x-14 swiper_{{ $escola->id }}_prev text-white"></div>

                                        <div class="w-[90%] swiper swiper_{{ $escola->id }}">
                                            <div class=" swiper-wrapper">


                                                @foreach ( $livrosAll as $livro )

                                                        <div id="card" class="flex flex-col items-center justify-center w-48 shadow-xl swiper-slide h-60 bg-gradient-to-t from-gray-300 to-gray-50">
                                                            <div wire:click="closeUser">
                                                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                            </div>
                                                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                                                        </div>
                                                        <div id="card" class="flex flex-col items-center justify-center w-48 shadow-xl swiper-slide h-60 bg-gradient-to-t from-gray-300 to-gray-50">
                                                            <div wire:click="closeUser">
                                                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                            </div>
                                                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                                                        </div>
                                                        <div id="card" class="flex flex-col items-center justify-center w-48 shadow-xl swiper-slide h-60 bg-gradient-to-t from-gray-300 to-gray-50">
                                                            <div wire:click="closeUser">
                                                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                            </div>
                                                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                                                        </div>
                                                        <div id="card" class="flex flex-col items-center justify-center w-48 shadow-xl swiper-slide h-60 bg-gradient-to-t from-gray-300 to-gray-50">
                                                            <div wire:click="closeUser">
                                                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                            </div>
                                                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                                                        </div>
                                                        <div id="card" class="flex flex-col items-center justify-center w-48 shadow-xl swiper-slide h-60 bg-gradient-to-t from-gray-300 to-gray-50">
                                                            <div wire:click="closeUser">
                                                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                            </div>
                                                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                                                        </div>


                                                @endforeach
                                            </div>

                                        </div>


                                    </div>
                                    <div class="h-10   bg-[url('./img/fundoDoTitulo.png')] bg-cover bg-center bg-no-repeat w-[70vw]  shadow-slate-900 shadow-xl"></div>
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

                <livewire:livro.edit/>
            </main>


            <script>


              </script>


</div>
