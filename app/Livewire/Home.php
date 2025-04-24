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
    public function convertPdfToImages()
{

}

    #[On('open-livro')]
    public function openLivro() {
        $this->hiddenOrShow = 'none';

    }



    public function render()
    {
        // $parser = new Parser();
        // $pdf = $parser->parseFile(storage_path('app/public/c.pdf'));

        // $text = $pdf->getText();
        // $this->html = nl2br($text);
        // $this->parteDoHtml1 = substr($this->html, 0, 1000);
        // $this->parteDoHtml2 = substr($this->html, 1001, 2000);
        // $this->parteDoHtml3 = substr($this->html, 2001, 3000);


        // $v = 0;

        // for($i = 0; $i < Str::length($text); $i += 1000) {
        //     $iAux = $i + 1000;
        //     $this->textArray[$v] = substr($text, $i, $iAux);
        //     $v++;

        // }


        $this->livrosAll = Livro::all();
        // $arquivos = File::files(public_path());

        // foreach ($arquivos as $arquivo) {
        // if (str_starts_with($arquivo->getFilename(), 'converted')) {
        // File::delete($arquivo->getPathname());
        // }
        // }

        // $imagick = new Imagick();
        // $imagick->setResolution(300, 300); // aumenta a qualidade
        // $imagick->readImage(storage_path('app/public/a.pdf'));
        // $imagick->setImageFormat('jpeg');
        // $imagick->writeImages('converted.jpg', true);
        //dd('Total de páginas convertidas: ' . $imagick->getNumberImages());
        //dd("done");




        return view('livewire.home');
    }
}
