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

    public $filtroDosLivrosPorSerie = null;

    public function visualizarEscolaEspecifica($escolaId) {

        $this->escolaSelecionadaId = $escolaId;

    }
    public function openLivro() {
        $this->hiddenOrShow = 'none';

    }


    #[On('user-deletado')]
    #[On('create-livro')]
    #[On('open-livro')]
    #[On('livro-deletado')]
    #[On('livro-updated')]
    public function render()
    {


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
        else {
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


        $this->escolaAllList = Escola::all();

        if ($this->escolaSelecionadaId !== null) {
            $this->escolaAllList = Escola::where('id', $this->escolaSelecionadaId)->get();
           $this->livrosAll = Livro::where('escola_id', $this->escolaSelecionadaId)->get();

        }


        $this->dispatch("escolas", ['escolas' => $this->escolaAllList]);


       // Gerar um identificador único e armazená-lo em um cookie



        return view('livewire.home');
    }
}
