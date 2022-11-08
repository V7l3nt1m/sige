<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissaos')->insert(
            ['nome_permissao' => "Tesouraria"]  
        );
        DB::table('permissaos')->insert(
            ['nome_permissao' => "Secretaria"]  
        );
        DB::table('permissaos')->insert(
            ['nome_permissao' => "Professor"]  
        );
        DB::table('permissaos')->insert(
            ['nome_permissao' => "Pcaadmin"]  
        );
    }
}
