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
            $table->id()->increments();
            $table->string('num_processo');
            $table->string('nome_aluno');
            $table->dateTime('data_nasc');
            $table->string('email_aluno');
            $table->string('telefone_aluno');
            $table->string('genero');
            $table->double('nota_aluno')->nullable();
            $table->float('num_faltas',3)->nullable();
            $table->boolean('estado_aprovado')->nullable();
            $table->double('propina')->nullable();
            $table->string('imagem_aluno');
            $table->string('senha_aluno');
            $table->rememberToken();
         
           
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
