<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Aluno;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Funcionarios;
use Illuminate\Support\Arr;



class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $nome = $faker->name;
        $email = $faker->email;
        $n_bi = rand(10000, 30000)."LA".rand(10000,30000);

        $funcionarios = DB::table('funcionarios')->get();

        $nome_escola_professor = DB::table('funcionarios')
        ->where('id', rand(1, count($funcionarios)))
        ->first();

        $cursos = DB::table('cursos')->get();
        $curso = DB::table('cursos')->where('id', rand(1, count($cursos)))->first();
        $classes = DB::table('classes')->get();
        $classe = DB::table('classes')->where('id', rand(1, count($classes)))->first();

        $turmas = DB::table('turmas')->get();
        $turma = DB::table('turmas')->where('id', rand(1, count($turmas)))->first();
        $disciplinas = DB::table('disciplinas')->get();
        $disciplina = DB::table('disciplinas')->where('id', rand(1, count($disciplinas)))->first();

        $users = DB::table('users')->orderBy('id', 'desc')->limit(1)->get();
        $users2 = DB::table('users')->orderBy('id', 'desc')->limit(1)->first();

        $alunos = DB::table('alunos')->orderBy('id', 'desc')->limit(1)->get();
        $alunos2 = DB::table('alunos')->orderBy('id', 'desc')->limit(1)->first();

        if (count($alunos) == 0) {
            $id = 1;
            $id_user = $users2->id + 1; 
            DB::table('users')->insert([
                    'id' => $id_user,
                    'name' => $nome,
                    'password' => Hash::make('Aluno2022'),
                    'email' => $email,
                    'permissao' => "aluno",
                    'n_bi' => $n_bi,
                    'nome_escola' => "ITEL",
            ]);
            DB::table('alunos')->insert([
                'id' => $id,
                'num_processo' => $faker->numberBetween($min = 10000, $max = 15000),
                'nome_aluno' => $nome,
                'data_nasc' => $faker->date(),
                'email_aluno' => $email,
                'telefone_aluno' => $faker->numberBetween($min = 900000000, $max = 999999999),
                'n_bi' => $n_bi,
                'genero' => Arr::random(['masculino', 'feminino']),
                'imagem_aluno' => '0b48f934439878d75489e256150a937a.png',
                'senha_aluno' => Hash::make('Aluno2022'),
                'nome_escola' => "ITEL",
                'user_id' => $id_user,
                'turma_id' => $turma->id,
                'curso_id' => $curso->id,
                'classe_id' => $classe->id,
            ]);
        }else{
            $id = $alunos2->id + 1;
            $id_user = $users2->id + 1; 
            DB::table('users')->insert([
                    'id' => $id_user,
                    'name' => $nome,
                    'password' => Hash::make('Aluno2022'),
                    'email' => $email,
                    'permissao' => "aluno",
                    'n_bi' => $n_bi,
                    'nome_escola' => "ITEL",
            ]);
            DB::table('alunos')->insert([
                'id' => $id,
                'num_processo' => $faker->numberBetween($min = 10000, $max = 15000),
                'nome_aluno' => $nome,
                'data_nasc' => $faker->date(),
                'email_aluno' => $email,
                'telefone_aluno' => $faker->numberBetween($min = 900000000, $max = 999999999),
                'n_bi' => $n_bi,
                'genero' => Arr::random(['masculino', 'feminino']),
                'imagem_aluno' => '0b48f934439878d75489e256150a937a.png',
                'senha_aluno' => Hash::make('Aluno2022'),
                'nome_escola' => "ITEL",
                'user_id' => $id_user,
                'turma_id' => $turma->id,
                'curso_id' => $curso->id,
                'classe_id' => $classe->id,
            ]);
        }

}
}
