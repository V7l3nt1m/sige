<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Disciplina;
use Faker\Factory as Faker;


class DisciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $disciplinas = DB::table('disciplinas')->orderBy('id', 'desc')->limit(1)->get();
        $disciplinas2 = DB::table('disciplinas')->orderBy('id', 'desc')->limit(1)->first();
        $cursos = DB::table('cursos')->get();
        $curso = DB::table('cursos')->where('id', rand(1, count($cursos)))->first();
        $classes = DB::table('classes')->get();
        $classe = DB::table('classes')->where('id', rand(1, count($classes)))->first();

        if (count($disciplinas) == 0) {
            $id = 1;
            DB::table('disciplinas')->insert([
                'id' => $id,
                'nome_disc' => $faker->word,
            ]);
            $disciplina = Disciplina::find($id);
            $disciplina->cursos()->attach($curso->id);
            $disciplina->classes()->attach($classe->id);
        }else{
            $id = $disciplinas2->id + 1;
            DB::table('disciplinas')->insert([
                'id' => $id,
                'nome_disc' => $faker->word,
            ]);
            $disciplina = Disciplina::find($id);
            $disciplina->cursos()->attach($curso->id);
            $disciplina->classes()->attach($classe->id);
        }
       
    }
}
