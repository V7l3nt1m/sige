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
            $table->string('num_processo')->unique();
            $table->string('nome_aluno');
            $table->dateTime('data_nasc');
            $table->string('email_aluno')->unique();
            $table->string('telefone_aluno')->unique();
            $table->string('n_bi')->unique();
            $table->string('genero');
            $table->float('num_faltas',3)->nullable();
            $table->string('estado_aprovado')->nullable();
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
