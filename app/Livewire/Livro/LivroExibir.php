<?php

namespace App\Livewire\Livro;
use Imagick;
use App\Models\Livro;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\File;


class LivroExibir extends Component
{
    public $descriptionLivro;
    public $modal;
    public $modalLivro = false;
    public $livro;
    public $nome_aluno;
    public $files = [];

    #[On('openLivro')]
    public function openModal($id){

        $this->modal = true;

        $this->livro = Livro::findOrFail($id);

        $this->descriptionLivro = $this->livro->description;
        $this->nome_aluno = $this->livro->nome_aluno;
    }

    public function visualizarLivro() {


        $this->modal = false;
        $imagick = new Imagick();
        //$imagick->setResolution(100, 100);
        $imagick->readImage(storage_path('app/public/storage/' . $this->livro->link));
        $imagick->setImageFormat('jpeg');


     $outputDir = public_path('livro/converted/');
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        $imagick->writeImages($outputDir . 'page_%03d.jpg', true);

        // Lista os arquivos gerados

        foreach (glob($outputDir . '*.jpg') as $file) {
            // Criar caminho relativo para usar com asset()
            $this->files[] = 'livro/converted/' . basename($file);
        }

        //dd($files);
        session(['livro' => $this->livro, 'images' => $this->files]);
        return redirect()->route('livro-carregado');
    }


    public function closeModal() {
        $this->modal = false;
    }

    #[On('livro-updated')]
    public function render()
    {

        return view('livewire.livro.livro-exibir');
    }
}
