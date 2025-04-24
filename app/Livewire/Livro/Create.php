<?php

namespace App\Livewire\Livro;

use App\Models\Livro;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    public $modal = false;
    public $name;
    public $description;
    public $uploadLivro;
    public $escola_id;


    use WithFileUploads;

    public function closeModal(){

        $this->modal = false;
    }

   // #[On('openModalCreate')]
    public function store() {
        $this->modal = true;
        $this->name = '';
        $this->description = '';
        $this->uploadLivro = null;
        $this->escola_id = '';

    }

    public function create() {




        //ATENCAO EXCLUIR A COLUNA IMAGEM PQ NAO VAI PRECISAR
      // dd($this->uploadLivro);


       
        $filePath = $this->uploadLivro->store('storage', 'public');
        $this->uploadLivro = str_replace('storage/', '', $filePath);

        // $this->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        //     'uploadLivro' => 'required|file',
        //     'escola_id' => 'required',

        // ]);

       //dd($this->name, $this->description, $this->uploadLivro, $this->escola_id, $this->uploadImage);

        $livro = Livro::create([
            'name' => $this->name,
            'description' => $this->description,
            'link' => $this->uploadLivro,
            'escola_id' => $this->escola_id,
        ]);


        $this->modal = false;
        $this->reset();
        $this->dispatch('create-livro');
    }


    public function render()
    {
        return view('livewire.livro.create');
    }
}
