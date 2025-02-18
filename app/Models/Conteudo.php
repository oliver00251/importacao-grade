<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    use HasFactory;

    protected $fillable = ['categoria_id', 'dados'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}

