<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class RegisterUser extends Component
{
    public $name, $email, $password, $modal = false;


    #[On('open-modal-user')]
    public function store() {
        $this->modal = true;
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function closeModal() {
        $this->modal = false;
        $this->reset();
    }



    public function create() {
        $this->validate([
             'name' => 'required|min:4|max:100',
             'email' => 'required|email|unique:users,email|min:4|max:100',
             'password' => 'required|min:8|max:100',
        ]);


         User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);



        $this->modal = false;
        $this->reset();


    }


    public function render()
    {
        return view('livewire.user.register-user');
    }
}
