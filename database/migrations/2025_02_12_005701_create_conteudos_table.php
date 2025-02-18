<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConteudosTable extends Migration
{
    public function up()
    {
        Schema::create('conteudos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade'); // Relaciona com 'categorias'
            $table->text('dados'); // Conteúdo relacionado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conteudos');
    }
}
