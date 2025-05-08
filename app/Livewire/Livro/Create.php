<?php

namespace App\Livewire\Livro;
use Imagick;
use App\Models\Livro;
use App\Models\Escola;
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
    public $nome_aluno;
    public $escola_id;
    public $escolaAll;

    use WithFileUploads;

    public function closeModal(){

        $this->modal = false;
    }


    public function convertPdfToImages()
    {
        $path = storage_path('app/public/capas');

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }


            $ultimoRegistroParaColocarImagemDeCapa = Livro::latest()->first();


            $imagick = new Imagick();
            $imagick->setResolution(300, 300);

            // Caminho completo do PDF, assumindo que $livro->link é algo como "nome.pdf"
            $pdfPath = storage_path('app/public/storage/' . $ultimoRegistroParaColocarImagemDeCapa->link);

            // Ler apenas a primeira página
            $imagick->readImage($pdfPath . '[0]');
            $imagick->setImageFormat('jpeg');

            // Nome da imagem com base no nome do livro (sem extensão)
            $filename = pathinfo($ultimoRegistroParaColocarImagemDeCapa->link, PATHINFO_FILENAME) . '.jpg';
            $savePath = $path . '/' . $filename;

            // Salvar a imagem
            $imagick->writeImages($savePath, false);

            // Atualizar a coluna image_capa no banco
            $ultimoRegistroParaColocarImagemDeCapa->update([
                'image_capa' => $filename
            ]);
    }





   // #[On('openModalCreate')]
    public function store() {
        $this->modal = true;
        $this->name = '';
        $this->description = '';
        $this->uploadLivro = null;
        $this->escola_id = '';
        $this->nome_aluno = '';
    }

    public function create() {
       


        $this->validate([
             'name' => 'required|min:4|max:100',
             'description' => 'required|min:4|max:200',
             'uploadLivro' => 'required',
             'escola_id' => 'required|integer',
             'nome_aluno' => 'required|string'
        ]);






        $filePath = $this->uploadLivro->store('storage', 'public');
        $this->uploadLivro = str_replace('storage/', '', $filePath);


       //dd($this->name, $this->description, $this->uploadLivro, $this->escola_id, $this->uploadImage);

        $livro = Livro::create([
            'name' => $this->name,
            'description' => $this->description,
            'link' => $this->uploadLivro,
            'escola_id' => $this->escola_id,
            'nome_aluno' =>$this->nome_aluno
        ]);


        $this->convertPdfToImages();
        $this->modal = false;
        $this->reset();
        $this->dispatch('create-livro');

    }


    public function render()
    {

        $this->escolaAll = Escola::all();

        return view('livewire.livro.create');
    }
}
