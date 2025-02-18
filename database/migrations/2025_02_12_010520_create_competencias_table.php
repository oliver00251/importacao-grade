<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenciasTable extends Migration
{
    public function up()
    {
        // Usando Schema::create para criar a tabela
        Schema::create('competencias', function (Blueprint $table) {
            // Coluna de ID
            $table->id();

            // Para Língua Portuguesa
            $table->string('ano_faixa')->nullable();
            $table->text('campos_atuacao')->nullable();
            $table->text('praticas_linguagem')->nullable();
            $table->text('objetos_conhecimento')->nullable();
            $table->text('habilidades')->nullable();
    
            // Para Arte
            $table->text('unidades_tematicas')->nullable();

            // Adicionando a coluna 'categoria'
            $table->text('categoria')->nullable();  // Esta coluna foi adicionada

            // Timestamps
            $table->timestamps();
        });
    }
    
    public function down()
    {
        // Usando Schema::dropIfExists para garantir que a tabela seja removida
        Schema::dropIfExists('competencias');
    }
}
