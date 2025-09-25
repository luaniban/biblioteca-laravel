<?php

namespace App\Livewire;
use Imagick;
use App\Models\Livro;
use App\Models\Escola;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class Home extends Component
{
    public $parteDoHtml1;

    public $parteDoHtml2;

    public $parteDoHtml3;

    public $html;

    public $textArray = [];

    public $livrosAll;

    public $modal = false;

    public $hiddenOrShow = 'hidden';

    public $script = '';

    public $filtroDosLivros;

    public $pesquisarEscola;

    public $escolaAll;

    public $filtroDasEscolas;

    public $pesquisarLivro;

    public $escolaSelecionadaId;

    public $tituloDaHome = "Todos os Livros";

    public $modalLoginUser = true;

    public $escolaAllList;

    public $escola;

    public $ordem ='';


    public $slide = false;


    public $filtroDosLivrosPorSerie = null;

    public function visualizarEscolaEspecifica($escolaId) {

        $this->escolaSelecionadaId = $escolaId;

    }
    public function openLivro() {
        $this->hiddenOrShow = 'none';

    }
    public function ativarSlide(){
        $this->slide = true;
    }


    #[On('user-deletado')]
    #[On('create-livro')]
    #[On('open-livro')]
    #[On('livro-deletado')]
    #[On('livro-updated')]
    public function render()
    {


        // $livros = Livro::all();
        // $arquivos = Storage::disk('public')->files('storage');
        // $nomesArquivos = array_map('basename', $arquivos);

        // foreach ($nomesArquivos as $arquivo) {
        //     $valor = 0;
        //     foreach ($livros as $livro) {
        //         if($arquivo !== $livro->link){
        //             $valor = 1;
        //         }
        //         else{
        //             $valor = 0;
        //         }
        //     }
        //     if($valor == 1){
        //         Storage::disk('public')->delete('storage/' . $arquivo);
        //     }
        // }


        //dd($nomesArquivos);
        if(\Route::currentRouteName() == 'dashboard' || \Route::currentRouteName() == 'home'){

            $arquivos = File::files(public_path('livro/converted/'));

            foreach ($arquivos as $arquivo) {
                if (str_starts_with($arquivo->getFilename(), 'page_')) {
                    File::delete($arquivo->getPathname());
                }
            }
        }


        if($this->escolaSelecionadaId !== null){
            $this->tituloDaHome = "";
        }

        if ($this->escolaSelecionadaId !== null) {
            $nameDaEscola = Escola::where('id', $this->escolaSelecionadaId)->first();
            $nameDaEscola = $nameDaEscola->name;

            $this->tituloDaHome = "Livros de " . $nameDaEscola;
            //$this->livrosAll = Livro::where('escola_id', $this->escolaSelecionadaId)->get();
        }

            if ($this->filtroDosLivros === 'AZ') {
                $this->ordem = 'AZ';
            } elseif ($this->filtroDosLivros === 'ZA') {
                $this->ordem = 'ZA';
            }
              elseif ($this->filtroDosLivrosPorSerie != null) {
                $this->ordem = "serie";
            } else {
                $this->ordem = '';
            }

        //dump($this->livrosAll);


        if ($this->filtroDasEscolas === 'AZ') {
            $this->escolaAll = Escola::orderBy('name', 'asc')->get();
        } elseif ($this->filtroDasEscolas === 'ZA') {
            $this->escolaAll = Escola::orderBy('name', 'desc')->get();
        } elseif (!empty($this->pesquisarEscola)) {
            $this->escolaAll = Escola::where('name', 'like', '%' . $this->pesquisarEscola . '%')->get();
        } else {
            $this->escolaAll = Escola::all();
        }



        $this->escolaAllList = Escola::orderByRaw("CASE WHEN name = ? THEN 0 ELSE 1 END", 'SECRETARIA MUNICIPAL DE EDUCAÇÃO')->orderBy('name', 'asc')->get();

        if ($this->escolaSelecionadaId !== null) {
            $this->escolaAllList = Escola::where('id', $this->escolaSelecionadaId)->get();
           $this->livrosAll = Livro::where('escola_id', $this->escolaSelecionadaId)->get();
        }


        $this->dispatch("escolas", ['escolas' => $this->escolaAllList]);


       // Gerar um identificador único e armazená-lo em um cookie



        return view('livewire.home');
    }
}
