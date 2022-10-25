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
use Faker\Generator as Faker;


class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $randomNumber = random_int(100000, 999999);
        DB::table('alunos')->insert([
            'num_processo' => $this->generateUniqueCode(),
            'nome_aluno' => Str::random(10),
            'email_aluno' => Str::random(10).'@gmail.com',
            'senha_aluno' => Hash::make('senha_aluno'),
            'telefone_aluno' => $this->generateUniqueTelefone(),
            'genero' => $faker->randomElement(['Masculino', 'Feminino']),
            'data_nasc' => $faker->dateTime(),
           
]);
    }
    public function generateUniqueCode()
    {
        do {
            $num_processo = random_int(10000, 18000);
        } while (Aluno::where("num_processo", "=", $num_processo)->first());
            return $num_processo;
    }

public function generateUniqueTelefone()
    {
        do {
            $telefone_aluno = random_int(900000000, 999999999);
        } while (Aluno::where("telefone_aluno", "=", $telefone_aluno)->first());
        return $telefone_aluno;
    }
}

