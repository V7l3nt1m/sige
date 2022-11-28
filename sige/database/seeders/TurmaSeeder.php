<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Turma;

class TurmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $turmas = DB::table('turmas')->orderBy('id', 'desc')->limit(1)->get();
        $turma = DB::table('turmas')->orderBy('id', 'desc')->limit(1)->first();
        $cursos = DB::table('cursos')->get();
        $curso = DB::table('cursos')->where('id', rand(1,count($cursos)))->first();
        $classes = DB::table('classes')->get();
        $classe = DB::table('classes')->where('id', rand(1, count($classes)))->first();

        if (count($turmas) == 0) {
            $id = 1;
        DB::table('turmas')->insert([
            'id' => $id,
            'nome_turma' => Str::random(10),
            'quantidade_alunos' => rand(0,56),
        ]);
        $tur = Turma::find($id);
        $tur->cursos()->attach($curso->id);
        $tur->classes()->attach($classe->id);

    }else{
        $id = $turma->id + 1;
        DB::table('turmas')->insert([
            'id' => $id,
            'nome_turma' => Str::random(10),
            'quantidade_alunos' => rand(0,56),
        ]);
        $tur = Turma::find($id);
        $tur->cursos()->attach($curso->id);
        $tur->classes()->attach($classe->id);
    }
    }
}
