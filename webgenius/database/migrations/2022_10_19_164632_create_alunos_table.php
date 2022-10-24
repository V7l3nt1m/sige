<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('num_processo');
            $table->string('nome_aluno');
            $table->dateTime('data_nasc');
            $table->string('email_aluno');
            $table->string('telefone_aluno');
            $table->string('genero');
            $table->double('nota_aluno');
            $table->float('num_faltas',3);
            $table->boolean('estado_aprovado');
            $table->double('propina');
            $table->string('imagem_aluno');
            $table->string('senha_aluno');
         
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
};
