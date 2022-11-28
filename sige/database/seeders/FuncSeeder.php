<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Faker\Factory as Faker;



class FuncSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    
    public function run()
    {
        $funcionarios = DB::table('funcionarios')->orderBy('id', 'desc')->limit(1)->get();
        $funcionarios2 = DB::table('funcionarios')->orderBy('id', 'desc')->limit(1)->first();
        $faker = Faker::create();
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
        $alunos = DB::table('alunos')
        ->where('turma_id', $turma->id)
        ->where('classe_id', $classe->id)
        ->where('curso_id', $curso->id)
        ->get();
        $nome = $faker->name;
        $email = $faker->email;
        $nome_escola = $faker->name;

        if (count($funcionarios) == 0) {
            $id = 1;
            $id_user = $users2->id + 1; 
            DB::table('users')->insert([
                'id' => $id_user,
                'name' => $nome,
                'password' => Hash::make('funcionario_2022'),
                'email' => $email,
                'permissao' => "professor",
                'n_bi' => rand(10000, 30000)."LA".rand(10000,30000),
                'nome_escola' => "ITEL",
            ]);
        DB::table('funcionarios')->insert([
            'id' => $id,
            'nome' => $nome,
            'senha_func' => Hash::make('funcionario_2022'),
            'data_nasc' => $faker->date(),
            'genero' => 'masculino',
            'tipo_fun' => 'professor',
            'telefone' => rand(900000000, 999999999),
            'email_fun' => $email,
            'imagem_fun' => '0b48f934439878d75489e256150a937a.png',
            'user_id' => $id_user,
            'nome_escola' => "ITEL", 
        ]);

        $fun = Funcionario::find($id);
        $fun->cursos()->attach($curso->id, ['classe_id' => $classe->id, 'disciplina_id' => $disciplina->id, 'turma_id' => $turma->id]);

    
        foreach ($alunos as $al) {
            DB::table('notas')->insert([
                'disciplina' => $disciplina->nome_disc,
                'aluno_id' => $al->id,
            ]);
        }

    }else{
        $id = $funcionarios2->id + 1;
        $id_user = $users2->id + 1; 
        DB::table('users')->insert([
            'id' => $id_user,
            'name' => $nome,
            'password' => Hash::make('funcionario_2022'),
            'email' => $email,
            'permissao' => "professor",
            'n_bi' => rand(0, 20)."LA".rand(0,20),
            'nome_escola' => $nome_escola,
        ]);
    DB::table('funcionarios')->insert([
        'id' => $id,
        'nome' => $nome,
        'senha_func' => Hash::make('funcionario_2022'),
        'data_nasc' => $faker->date(),
        'genero' => 'masculino',
        'tipo_fun' => 'professor',
        'telefone' => rand(900000000, 999999999),
        'email_fun' => $email,
        'imagem_fun' => '0b48f934439878d75489e256150a937a.png',
        'user_id' => $id_user,
        'nome_escola' => $nome_escola, 
    ]);
    $fun = Funcionario::find($id);
    $fun->cursos()->attach($curso->id, ['classe_id' => $classe->id, 'disciplina_id' => $disciplina->id, 'turma_id' => $turma->id]);
    foreach ($alunos as $al) {
        DB::table('notas')->insert([
            'disciplina' => $disciplina->nome_disc,
            'aluno_id' => $al->id,
        ]);
    }

    }
    }
    }


