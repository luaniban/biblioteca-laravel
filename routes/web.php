<?php

use App\Livewire\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroCarregado;






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/livro-exibir', [LivroCarregado::class, 'render'])->name('livro-carregado');
    Route::get('/', Home::class)->name('dashboard');
});
