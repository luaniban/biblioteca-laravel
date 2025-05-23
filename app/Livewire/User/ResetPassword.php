<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;

class ResetPassword extends Component
{
    use Interactions;


    #[On('reset-password-user')]
    public function resetPassword($id) {
        $user = User::find($id);
        $user->password = bcrypt('Atividade1!');
        $this->toast()->success('Senha resetada para "Atividade1!" com sucesso 🔑')->send();
        $user->save();
    }



    public function render()
    {
        return view('livewire.user.reset-password');
    }
}
