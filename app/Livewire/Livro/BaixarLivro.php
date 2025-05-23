<?php

namespace App\Livewire\Livro;

use Livewire\Component;

use setasign\Fpdi\Fpdi;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\Storage;

class BaixarLivro extends Component
{

    #[On('baixar-book')]
    public function baixarPdf($link)
    {
        $caminho = storage_path('app/public/storage/' . $link);

        if (!file_exists($caminho)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return response()->download($caminho, 'livro-baixado.pdf');
    }


    public function render()
    {
        return view('livewire.livro.baixar-livro');
    }
}
