<div>
    <livewire:livro.livro-exibir/>
    <div class="flex">
        <section class="h-screen w-56 bg-[#BDD2F9] flex flex-col  items-center space-y-8 px-2 pb-4">
            <img src="./img/logo-prefeitura.png" alt="Logo da prefeitura">
            <hr class="w-full">
           <div class="flex flex-col items-center w-full h-full px-4 py-4 bg-white rounded-md">
                <input id="searchSchool" class="bg-[#EAF4FF] text-[#A3B2D8] font-bold w-full py-1 rounded-md text-center border-gray-300 focus:outline-none " placeholder="Pesquisar..." >
                <select name="" id="Filtro de escolas" class="bg-[#084E80] text-white font-semibold  py-1  px-2 rounded-md text-center mt-4">
                    <option value="AZ" >A-Z</option>
                    <option value="AZ" >A-Z</option>
                    <option value="AZ" >A-Z</option>
                </select>

                <div class="w-full mt-4 overflow-y-auto">
                    <div class="max-h-[50vh] flex flex-col gap-5 mt-4 ">

                        <p  class="text-[#084E80] font-semibold hover:cursor-pointer px-2 py-1 hover:bg-gray-100 ">Escola Exemplo 1</p>
                        <hr class="w-[85%]">

                        <p class="text-[#084E80] font-semibold hover:cursor-pointer hover:bg-gray-100 px-2 py-1">Escola Exemplo 2</p>
                        <hr class="w-[85%]">

                        <p class="text-[#084E80] font-semibold hover:cursor-pointer hover:bg-gray-100 px-2 py-1">Escola Exemplo 3</p>
                        <hr class="w-[85%]">

                        <p class="text-[#084E80] font-semibold hover:cursor-pointer hover:bg-gray-100 px-2 py-1">Escola Exemplo 4</p>
                        <hr class="w-[85%]">

                        <p class="text-[#084E80] font-semibold hover:cursor-pointer hover:bg-gray-100 px-2 py-1">Escola Exemplo 5</p>
                        <hr class="w-[85%]">

                        <p class="text-[#084E80] font-semibold hover:cursor-pointer hover:bg-gray-100 px-2 py-1">Escola Exemplo 4</p>
                        <hr class="w-[85%]">

                        <p class="text-[#084E80] font-semibold hover:cursor-pointer hover:bg-gray-100 px-2 py-1">Escola Exemplo 5</p>
                        <hr class="w-[85%]">

                        <p class="text-[#084E80] font-semibold hover:cursor-pointer hover:bg-gray-100 px-2 py-1">Escola Exemplo 4</p>
                        <hr class="w-[85%]">

                        <p class="text-[#084E80] font-semibold hover:cursor-pointer hover:bg-gray-100 px-2 py-1">Escola Exemplo 5</p>
                        <hr class="w-[85%]">

                        <p class="text-[#084E80] font-semibold hover:cursor-pointer hover:bg-gray-100 px-2 py-1">Escola Exemplo 4</p>
                        <hr class="w-[85%]">

                </div>

                </div>


           </div>
        </section>
        <div class="flex flex-col w-full">
            <header class=" h-[10vh] bg-gradient-to-r from-[#084E80] to-[#0D76C0]">
                <nav class="flex items-center justify-end w-full h-full px-2">

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
                </nav>
            </header>
            <main class="w-full h-[90vh] bg-white p-8">
                <div class="w-full h-full p-8 overflow-y-auto bg-white">
                    <div class="flex items-center w-full gap-8">
                        <input id="searchSchool" class="bg-[#EAF4FF] text-[#A3B2D8] font-bold px-2 py-1 rounded-md text-center border-gray-300 focus:outline-none focus:border" placeholder="Pesquisar Obras... " >
                        <select name="" id="Filtro de escolas" class="bg-[#084E80] text-white font-semibold  py-1  px-2 rounded-md text-center " >
                            <option>Filtrar</option>
                            <option value="AZ" >A-Z</option>
                            <option value="AZ" >A-Z</option>
                            <option value="AZ" >A-Z</option>
                        </select>

                     

                            <livewire:livro.create/>
                        </div>
                        <div class="flex flex-wrap w-full gap-4 mt-8">

                        @foreach ($livrosAll as $livro)
                        <div id="card" class="flex flex-col items-center justify-center w-40 bg-gray-200 h-60">
                       
                            <button class=" rounded-md w-28 h-36 hover:h-40 hover:w-32 focus:h-40 focus:w-32" @click="$dispatch('openLivro', {id: {{ $livro->id }}})"><img src="{{ asset('storage/capas/' . $livro->image_capa) }}"></button>
                            <div class="mt-6 text-lg font-semibold text-gray-800 ">{{ $livro->name }}</div>
                        </div>
                        @endforeach

                    </div>


                </div>

                <livewire:livro.edit/>
            </main>

</div>
