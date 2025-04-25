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

    public function visualizarEscolaEspecifica($escolaId) {

        $this->escolaSelecionadaId = $escolaId;

    }
    public function openLivro() {
        $this->hiddenOrShow = 'none';

    }


    #[On('create-livro')]
    #[On('open-livro')]
    public function render()
    {

        if($this->escolaSelecionadaId !== null){
            $this->tituloDaHome = "";
        }

        if ($this->escolaSelecionadaId !== null) {
            $nameDaEscola = Escola::where('id', $this->escolaSelecionadaId)->first();
            $nameDaEscola = $nameDaEscola->name;

            $this->tituloDaHome = "Livros de " . $nameDaEscola;
            $this->livrosAll = Livro::where('escola_id', $this->escolaSelecionadaId)->get();
        }
        else {
            if ($this->filtroDosLivros === 'AZ') {
                $this->livrosAll = Livro::orderBy('name', 'asc')->get();
            } elseif ($this->filtroDosLivros === 'ZA') {
                $this->livrosAll = Livro::orderBy('name', 'desc')->get();
            } elseif (!empty($this->pesquisarLivro)) {
                $this->livrosAll = Livro::where('name', 'like', '%' . $this->pesquisarLivro . '%')->get();
            } else {
                $this->livrosAll = Livro::all();
            }
        }

        if ($this->filtroDasEscolas === 'AZ') {
            $this->livrosAll = Escola::orderBy('name', 'asc')->get();
        } elseif ($this->filtroDasEscolas === 'ZA') {
            $this->escolaAll = Escola::orderBy('name', 'desc')->get();
        } elseif (!empty($this->pesquisarEscola)) {
            $this->escolaAll = Escola::where('name', 'like', '%' . $this->pesquisarEscola . '%')->get();
        } else {
            $this->escolaAll = Escola::all();
        }

        return view('livewire.home');
    }
}
