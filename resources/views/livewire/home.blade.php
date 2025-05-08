<div >
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


                <div class="w-full h-full mt-4 ml-12 mr-8 overflow-y-auto scrollbar-thin-custom">
                    <div class="max-h-[50vh] flex flex-col gap-5 mt-4 ">
                        @foreach ($escolaAll as $escola)
                            <p wire:click="visualizarEscolaEspecifica({{ $escola->id }})"  class="text-[#084E80] font-semibold hover:cursor-pointer px-2 py-1 hover:bg-gray-100 text-sm text-center">{{ $escola->name }}</p>
                            <hr class="w-[85%]">
                        @endforeach
                    </div>
                </div>
           </div>
        </section>
        <div class="h-full w-60">

        </div>
        <div class="flex flex-col w-full">
            <header class=" h-[10vh] bg-gradient-to-r from-[#084E80] to-[#0D76C0]">
                <nav class="flex items-center justify-end w-full h-full px-2">
                    @if($modalLoginUser)
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Teams Dropdown -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="relative ms-3">
                                    <x-dropdown align="right" width="60">
                                        <x-slot name="trigger">
                                            <span class="inline-flex rounded-md">


                                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700">
                                                    {{ Auth::user()->currentTeam->name }}

                                                    <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                    </svg>
                                                </button>

                                            </span>
                                        </x-slot>

                                        <x-slot name="content">
                                            <div class="w-60">
                                                <!-- Team Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Manage Team') }}
                                                </div>

                                                <!-- Team Settings -->
                                                <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                    {{ __('Team Settings') }}
                                                </x-dropdown-link>

                                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                    <x-dropdown-link href="{{ route('teams.create') }}">
                                                        {{ __('Create New Team') }}
                                                    </x-dropdown-link>
                                                @endcan

                                                <!-- Team Switcher -->
                                                @if (Auth::user()->allTeams()->count() > 1)
                                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        {{ __('Switch Teams') }}
                                                    </div>

                                                    @foreach (Auth::user()->allTeams() as $team)
                                                        <x-switchable-team :team="$team" />
                                                    @endforeach
                                                @endif
                                            </div>
                                        </x-slot>
                                    </x-dropdown>
                                </div>

                        @endif

                        <!-- Settings Dropdown -->
                        <div class="relative ms-3">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                            <img class="object-cover rounded-full size-8" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white transition duration-150 ease-in-out border border-transparent rounded-md hover:text-gray-200 focus:outline-none focus:bg-white active:bg-gray-50 focus:text-blue-500">
                                                {{ Auth::user()->name }}

                                                <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200 "></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}"
                                                 @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                    @endif
                </nav>
            </header>
            <main class="w-full h-full p-8 bg-[#c5d3ff]">

                    <h1 class="text-2xl font-bold ">{{ $tituloDaHome }}</h1>


                <div class="w-full  p-8  bg-[#c5d3ff]">
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

                                $this->dispatch("escolas", ['escolas' => $escolaAll])

                            @endphp



                            @foreach ($escolaAll as $escola)

                            @php

                                $livros = Livro::where('escola_id', $escola->id)->get();

                            @endphp
                                @if( $livros->isNotEmpty() )
                                <div class="w-full">

                                <div class="mb-4 text-xl">{{$escola->name }}</div>

                                    <div class="flex px-4 py-4 shadow-lg w-[70vw] bg-amber-800 shadow-slate-700 relative">
                                        <div class="scale-75 translate-x-14 swiper-button-next swiper_{{ $escola->id }}_next"></div>
                                        <div class="scale-75 swiper-button-prev -translate-x-14 swiper_{{ $escola->id }}_prev"></div>

                                        <div class="w-full swiper swiper_{{ $escola->id }}">
                                            <div class="swiper-wrapper">
                                                @foreach ( $livros as $livro )


                                                        <div id="card" class="flex flex-col items-center justify-center w-40 shadow-md swiper-slide h-60 bg-gradient-to-t from-gray-300 to-gray-50 shadow-slate-900">
                                                            <div wire:click="closeUser">
                                                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                            </div>
                                                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                                                        </div>
                                                        <div id="card" class="flex flex-col items-center justify-center w-40 shadow-md swiper-slide h-60 bg-gradient-to-t from-gray-300 to-gray-50 shadow-slate-900">
                                                            <div wire:click="closeUser">
                                                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                            </div>
                                                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                                                        </div>
                                                        <div id="card" class="flex flex-col items-center justify-center w-40 shadow-md swiper-slide h-60 bg-gradient-to-t from-gray-300 to-gray-50 shadow-slate-900">
                                                            <div wire:click="closeUser">
                                                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                            </div>
                                                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                                                        </div>
                                                        <div id="card" class="flex flex-col items-center justify-center w-40 shadow-md swiper-slide h-60 bg-gradient-to-t from-gray-300 to-gray-50 shadow-slate-900">
                                                            <div wire:click="closeUser">
                                                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                            </div>
                                                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                                                        </div>
                                                        <div id="card" class="flex flex-col items-center justify-center w-40 shadow-md swiper-slide h-60 bg-gradient-to-t from-gray-300 to-gray-50 shadow-slate-900">
                                                            <div wire:click="closeUser">
                                                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                            </div>
                                                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                                                        </div>
                                                        <div id="card" class="flex flex-col items-center justify-center w-40 shadow-md swiper-slide h-60 bg-gradient-to-t from-gray-300 to-gray-50 shadow-slate-900">
                                                            <div wire:click="closeUser">
                                                                <button class="rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                                                            </div>
                                                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                                                        </div>


                                                @endforeach
                                            </div>

                                        </div>


                                    </div>
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
