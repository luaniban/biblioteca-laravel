<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LivroCarregado extends Controller
{
    public function render() {

        $images = session('images', []);

        $livro = session('livro');
        $livro_formato = $livro->livro_formato;

        $width = "1100px";
        $height = "700px";

        if($livro_formato == 'paisagem'){
            $width = "1400px";
            $height = "500px";
        }
        else{
            $width = "1100px";
            $height = "700px";
        }


        return view('livro-carregado', ['images' => $images,  'width' => $width, 'height' => $height]);
    }
}
