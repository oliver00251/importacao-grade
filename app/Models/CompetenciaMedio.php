<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenciaMedio extends Model
{
    use HasFactory;
    protected $table = 'competencia-medio';
    protected $fillable = ['disciplina', 'serie', 'tema', 'descricao', 'habilidade'];

}
