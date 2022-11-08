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
        Schema::create('escolas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_escola');
            $table->string('n_registro')->nullable();
            $table->string('contrato');
            $table->string('pacote');
            $table->string('n_bi');
            $table->string('email');
            $table->double('valor_p_aluno');
            $table->string('telefone');
            $table->string('cidade')->nullable();
            $table->string('Municipio/Bairro/Escola')->nullable();
            $table->string('logo_escola')->nullable();
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
        Schema::dropIfExists('escolas');
    }
};
