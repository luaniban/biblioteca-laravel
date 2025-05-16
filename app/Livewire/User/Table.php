<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class Table extends Component
{
    public $users;
    public $modal = false;

    #[On('open-table-user')]
    public function openModal(){
        $this->modal = true;
    }
    public function closeModal(){
        $this->modal = false;
    }


    #[On('user-deletado')]
    #[On('user-updated')]
    #[On('user-created')]
    public function render()
    {
        $this->users = User::all();

        return view('livewire.user.table');
    }
}
