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


    #[On('openLivro')]
    public function openModal($id){

        $this->modal = true;

        $this->livro = Livro::findOrFail($id);
       
        $this->descriptionLivro = $this->livro->description;
    }

    public function visualizarLivro() {


        $this->modal = false;


    $arquivos = File::files(public_path('livro/converted/'));

        foreach ($arquivos as $arquivo) {
            if (str_starts_with($arquivo->getFilename(), 'page_')) {
                File::delete($arquivo->getPathname());
            }
        }


        $imagick = new Imagick();
        $imagick->setResolution(300, 300); // aumenta a qualidade
        $imagick->readImage(storage_path('app/public/storage/' . $this->livro->link));
        $imagick->setImageFormat('jpeg');


     $outputDir = public_path('livro/converted/');
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        $imagick->writeImages($outputDir . 'page_%03d.jpg', true);

        // Lista os arquivos gerados
        $files = [];
        foreach (glob($outputDir . '*.jpg') as $file) {
            // Criar caminho relativo para usar com asset()
            $files[] = 'livro/converted/' . basename($file);
        }

        //dd($files);
        session(['images' => $files]);
        return redirect()->route('livro-carregado');
    }


    public function render()
    {
        return view('livewire.livro.livro-exibir');
    }
}
