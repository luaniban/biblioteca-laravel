<div>
    @if($modal)
    <div class="fixed inset-0 flex items-center justify-center transition-all duration-300 ease-out bg-gray-500 bg-opacity-75 z-[50]" wire:click="closeModal">
        <!-- Modal -->
        <div class="w-1/2 p-6 bg-white rounded-lg" wire:click.stop>
            <div>


                <button class="px-3 py-2 mb-2 font-semibold text-white bg-gray-800 rounded-md text-md hover:bg-gray-900" @click="$dispatch('open-modal-user')">Criar Usuário</button>
                <table class="w-full">
                    <thead>
                      <tr class="border ">
                        <th class="py-2 bg-gray-300">Nome</th>
                        <th class="py-2 bg-gray-300">Email</th>
                        <th class="py-2 bg-gray-300">Ações</th>
                      </tr>
                    </thead>
                    <tbody class="py-2">
                        @foreach ($users as $user)
                            <tr class="border odd:bg-white even:bg-gray-100 hover:bg-gray-200">
                                <td class="px-2 py-2 border">{{ $user->name }}</td>
                                <td class="px-2 py-2 border">{{ $user->email }}</td>
                                <td class="flex gap-2 px-2 py-2">
                                    <button class="px-3 py-2 mb-2 font-semibold text-white bg-blue-700 rounded-md text-md hover:bg-blue-800" @click="$dispatch('edit-user', {id: {{ $user->id }}})"><img src="./img/edit.png" alt="" class="w-4 h-4"></button>
                                    <button class="px-3 py-2 mb-2 font-semibold text-white bg-red-700 rounded-md text-md hover:bg-red-800" @click="$dispatch('destroy-user', {id: {{ $user->id }}})"><img src="./img/delete.png" alt="" class="w-4 h-4"></button>
                                    <button class="px-3 py-2 mb-2 font-semibold text-white bg-yellow-700 rounded-md text-md hover:bg-yellow-800" @click="$dispatch('reset-password-user', {id: {{ $user->id }}})"><img src="./img/reset.png" alt="" class="w-4 h-4"></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>

            </div>
        </div>
    </div>



    @endif
    <x-ts-toast/>
    <livewire:user.register-user>
    <livewire:user.reset-password>
    <livewire:user.edit>
    <livewire:user.delete>
</div>
