<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_capa',
        'nome_aluno',
        'escola_id',
        'link',
        'serie',
        'livro_formato'
    ];
}
