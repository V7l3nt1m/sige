<?php

namespace App\Console\Commands;
use App\Models\Aluno;
use Illuminate\Console\Command;

class AprovarAlunos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ActualizarClassesAlunos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Todos os alunos aprovados vao mudar de classe automaticamente';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $joao = Aluno::where('estado_aprovado', "Apto")->select('nota_aluno')
        ->get();
    
    foreach ($joao as $j) {
        Aluno::where('nome_aluno', "carina")->update(['nota_aluno' => intval($j->nota_aluno) + 1]);
    }
    }
}
