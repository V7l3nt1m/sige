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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('disciplina')->nullable();
            $table->unsignedBigInteger('aluno_id');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->double('t1_p1')->nullable();
            $table->double('t1_p2')->nullable();
            $table->double('t1_mac')->nullable();
            $table->double('t1_mdf')->nullable();
            $table->double('t2_p1')->nullable();
            $table->double('t2_p2')->nullable();
            $table->double('t2_mac')->nullable();
            $table->double('t2_mdf')->nullable();
            $table->double('t3_p1')->nullable();
            $table->double('t3_mac')->nullable();
            $table->double('t3_pf')->nullable();
            $table->double('t3_mdf')->nullable();
            $table->double('recurso')->nullable();
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
        Schema::dropIfExists('notas');
    }
};
