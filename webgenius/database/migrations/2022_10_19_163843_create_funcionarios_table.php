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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome',30);
            $table->date('data_nasc');
            $table->string('genero');
            $table->string('tipo_fun',10);
            $table->string('telefone',20);
            $table->string('email_fun');
            $table->string('folha_salario');
            $table->decimal('faltas');
            $table->string('imagem_fun'); 
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
        Schema::dropIfExists('funcionarios');
    }
};
