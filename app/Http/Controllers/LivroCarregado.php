<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LivroCarregado extends Controller
{
    public function render() {

        $images = session('images', []);

       // dd($images);


        return view('livro-carregado', compact('images'));
    }
}
