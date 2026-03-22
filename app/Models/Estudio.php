<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo'];

    // Um Estúdio tem muitos Filmes
    public function filmes()
    {
        return $this->hasMany(Filme::class, 'estudio_id');
    }
}
