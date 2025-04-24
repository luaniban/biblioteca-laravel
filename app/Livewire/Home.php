<?php

namespace App\Livewire;
use Imagick;
use App\Models\Livro;
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

    public function openLivro() {
        $this->hiddenOrShow = 'none';

    }



    #[On('create-livro')]
    #[On('open-livro')]
    public function render()
    {

        if($this->filtroDosLivros == null || $this->filtroDosLivros == ""){
            $this->livrosAll = Livro::all();

        }
        elseif($this->filtroDosLivros == 'AZ'){
            $this->livrosAll = Livro::orderBy('name', 'asc')->get();
        }
        elseif($this->filtroDosLivros == 'ZA'){
            $this->livrosAll = Livro::orderBy('name', 'desc')->get();
        }


        if($this->pesquisarEscola != null || $this->pesquisarEscola != ""){
            $this->livrosAll = Livro::where('name', 'like', '%' . $this->pesquisarEscola . '%')->get();
        }





        return view('livewire.home');
    }
}
