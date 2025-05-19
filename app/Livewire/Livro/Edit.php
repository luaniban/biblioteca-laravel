<?php

namespace App\Livewire\Livro;

use App\Models\Livro;
use App\Models\Escola;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class Edit extends Component
{

    use Interactions;
    use WithFileUploads;

    public $modal = false;
    public $name;
    public $description;
    public $nome_aluno;
    public $escola_id;
    public $livro;
    public $escolaAll;

    #[On('edit-book')]
    public function openModal($id) {
        $this->livro = Livro::findOrFail($id);
        $this->name = $this->livro->name;
        $this->description = $this->livro->description;
        $this->escola_id = $this->livro->escola_id;
        $this->nome_aluno = $this->livro->nome_aluno;
        $this->escolaAll = Escola::all();

        $this->modal = true;
    }

    public function closeModal() {
        $this->modal = false;
    }

    public function update(){
        $this->validate([
            'name' => 'required|min:4|max:100',
            'description' => 'required|min:4|max:200',
            'escola_id' => 'required|integer',
            'nome_aluno' => 'required|string'
       ]);

        $this->livro->update([
            'name' => $this->name,
            'description' => $this->description,
            'escola_id' => $this->escola_id,
            'nome_aluno' =>$this->nome_aluno
        ]);
        $this->dispatch('livro-updated');
        $this->modal = false;
        $this->toast()->success('Livro atualizado com sucesso')->send();
    }
    public function render()
    {
        return view('livewire.livro.edit');
    }
}
