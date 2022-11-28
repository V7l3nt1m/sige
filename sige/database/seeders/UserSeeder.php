<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => "admin",
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'n_bi' => rand(0,10)."LA".rand(0,10),
                'permissao' => 'pcaadmin',
                'nome_escola' => Str::random(10),
            ]
        );
    }
}
