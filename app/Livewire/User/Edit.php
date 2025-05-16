<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;

class Edit extends Component
{
    use Interactions;

    public $user;
    public $modal = false;
    public $name;
    public $email;


    #[On('edit-user')]
    public function openModal($id){
        $this->user = User::findOrFail($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->modal = true;
    }

    public function closeModal(){
        $this->modal = false;
    }

    public function update(){

        $this->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->save();
        $this->toast()->success('Usuário atualizado com sucesso ✏️')->send();
        $this->closeModal();
        $this->dispatch('user-updated');
    }


    public function render()
    {
        return view('livewire.user.edit');
    }
}
