<?php

namespace App\Jobs;

use App\Models\Livro;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessarLivro implements ShouldQueue
{
    use Queueable;

    protected $livro;

    public function __construct(Livro $livro)
    {
        $this->livro = $livro;
    }


    public function handle(): void
    {
        //
    }
}
