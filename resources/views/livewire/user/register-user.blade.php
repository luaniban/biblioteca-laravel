<div>
    @if($modal)
    <div class="fixed inset-0 flex items-center justify-center transition-all duration-300 ease-out bg-gray-500 bg-opacity-75 z-[50]" wire:click="closeModal">
        <!-- Modal -->
        <div class="w-1/2 p-6 bg-white rounded-lg" wire:click.stop>
            <h2 class="mb-2 text-2xl font-semibold">Criar Usuário</h2>
            <hr class="w-full mb-6">
            <form wire:submit.prevent="create">
            <div class="grid items-center justify-center w-full grid-cols-12 gap-4 mb-6">
                <div class="col-span-6">
                    <label for="name" class="text-gray-800">Nome do usuário<span class="ml-1 text-red-600">*</span></label>
                    <x-ts-input type="text" class="w-full border-gray-200 shadow-lg " wire:model="name"/>
                    @error('name')
                        <span class="text-red-600">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-span-6">
                    <label for="name" class="text-gray-800">Escola<span class="ml-1 text-red-600">*</span></label>

                    @php
                        $options = [];
                        foreach ($escolaAll as $escola) {
                            $options[] = ['label' => $escola->name, 'value' => $escola->id];
                        }
                    @endphp
                    <div  class="border-gray-200 shadow-lg">
                        <x-ts-select.styled  wire:model="escola_id" :options="$options" searchable />
                    </div>

                    @error('escola_id')
                        <span class="text-red-600">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-span-6">
                    <label for="name" class="text-gray-800">Email<span class="ml-1 text-red-600">*</span></label>
                    <x-ts-input type="text" class="text-sm border-gray-200 shadow-lg w-[100%]" wire:model="email" />

                    @error('email')
                        <span class="text-red-600">{{$message}}</span>
                    @enderror
                </div>
                <div  class="col-span-6">
                    <label for="name" class="text-gray-800 ">Senha<span class="ml-1 text-red-600">*</span></label>
                    <x-ts-password type="text" class="w-full border-gray-200 shadow-lg" wire:model="password"></x-ts-password>
                    @error('password')
                        <span class="text-red-600">{{$message}}</span>
                    @enderror
                </div>


            </div>
            <hr class="w-full mt-6 mb-4">
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 mr-2 text-white bg-blue-600 rounded-md shadow-lg cursor-pointer hover:bg-blue-700">
                    Salvar
                </button>
                <button wire:click="closeModal" class="px-4 py-2 text-white bg-red-600 rounded-md shadow-lg cursor-pointer hover:bg-red-700">
                    Fechar
                </button>

            </div>
        </form>
        </div>
    </div>



    @endif
</div>
