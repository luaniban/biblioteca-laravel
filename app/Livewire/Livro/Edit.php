<?php

namespace App\Livewire\Livro;

use Livewire\Component;
use Livewire\Attributes\On;

class Edit extends Component
{
    public $modal = false;

    #[On('openModalEdit')]
    public function openModal($value) {

        
        if($this->modal == false){
            $this->modal = true;
        }
        else{
            $this->modal = false;
        }
    }
    public function render()
    {
        return view('livewire.livro.edit');
    }
}
