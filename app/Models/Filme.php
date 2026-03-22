<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudio_id',
        'titulo',
        'capa',
        'data_lancamento',
        'genero'
    ];

    // Um Filme pertence a um Estúdio
    public function estudio()
    {
        return $this->belongsTo(Estudio::class, 'estudio_id');
    }
}
