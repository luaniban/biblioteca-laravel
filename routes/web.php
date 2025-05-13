<?php

use App\Livewire\Home;
use App\Livewire\HomeUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroCarregado;






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Route::get('/admin', Home::class)->name('dashboard');
});

Route::get('/dashboard', Home::class)->name('dashboard');
Route::get('/livro-exibir', [LivroCarregado::class, 'render'])->name('livro-carregado');