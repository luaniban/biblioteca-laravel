<?php

namespace App\Livewire\Livro;

use App\Models\Livro;
use Livewire\Component;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;

class Delete extends Component
{
    use Interactions;

    public $modal = false;
    public $livro;
    public $name;
    public $nameDoAluno;

    #[On('deleteLivro')]
    public function openModal($id){
        $this->livro = Livro::findOrFail($id);
        $this->name = $this->livro->name;
        $this->nameDoAluno = $this->livro->nome_aluno;
        $this->modal = true;
    }
    public function closeModal(){
        $this->modal = false;
    }
    public function delete(){
        $this->livro->delete();
        $this->closeModal();
        $this->toast()->success('Livro deletado com sucesso')->send();
        $this->dispatch('livro-deletado');
    }

    public function render()
    {
        return view('livewire.livro.delete');
    }
}
