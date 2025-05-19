<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NewPassword extends Component
{
    public $modal = true;
    public $password = '';
    public $user;




    public function closeModal(){
        $this->modal = false;
    }

    public function savePassword() {
        $this->validate([
            'password' => 'required|min:8',
        ]);

        $this->user = Auth::user();
        $this->user->password = Hash::make($this->password);
        $this->user->save();
        
        $this->closeModal();
        $this->dispatch('password-updated');
    }

    public function render()
    {
        return view('livewire.user.new-password');
    }
}
