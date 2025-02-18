<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $fillable = [
        'ano_faixa', 
        'campos_atuacao', 
        'praticas_linguagem', 
        'objetos_conhecimento', 
        'habilidades', 
        'unidades_tematicas',
        'categoria'  // Certifique-se de adicionar a coluna 'categoria' se for necessário
    ];
}
