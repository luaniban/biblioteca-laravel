<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;

class Delete extends Component
{
    use Interactions;
    
    public $modal = false;
    public $user;
    public $name;
    public $email;

    #[On('destroy-user')]
    public function openModal($id){
        $this->user = User::findOrFail($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->modal = true;
    }
    public function closeModal(){
        $this->modal = false;
    }
    public function delete(){
        $this->user->delete();
        $this->closeModal();
        $this->toast()->success('Usuário deletado com sucesso')->send();
        $this->dispatch('user-deletado');
    }



    public function render()
    {
        return view('livewire.user.delete');
    }
}
