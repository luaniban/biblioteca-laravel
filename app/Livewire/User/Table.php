<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $modal = false;
    public $pesquisarUser;

    #[On('open-table-user')]
    public function openModal()
    {
        $this->modal = true;
    }

    public function closeModal()
    {
        $this->modal = false;
    }

    #[On('user-deletado')]
    #[On('user-updated')]
    #[On('user-created')]
    public function render()
    {
        $users = User::paginate(5);

        if (!empty($this->pesquisarUser)) {
            $users = User::where('name', 'like', '%' . $this->pesquisarUser . '%')->paginate(5);
        }

        return view('livewire.user.table', [
            'users' => $users,
        ]);


    }
}