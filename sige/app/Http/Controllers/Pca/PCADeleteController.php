<?php

namespace App\Http\Controllers\Pca;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Nota;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Classe;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class PCADeleteController extends PCAController
{
 //destroy alunos
 public function destroy_alunos($id){
    Aluno::findOrFail($id)->delete();

    return redirect('/pcaadmin/alunos')->with('msg', 'Aluno Eliminado com sucesso!');
}
    //eliminar funcionario
    public function destroy_funcionarios($id){
        $funcionario = Funcionario::findOrFail($id);

        $user_funcionario = DB::table('funcionarios')
        ->select('users.id')
        ->join('users', 'users.id', 'funcionarios.user_id')
        ->where('funcionarios.id', $id)
        ->get();

        if(strcasecmp($funcionario->tipo_fun, "professor") == 0){

        $classe_dados = DB::table('classe_curso_disciplina_funcionario_turma')
        ->where('classe_curso_disciplina_funcionario_turma.funcionario_id', $id)
        ->get();   
        

   $query4 = DB::table('disciplina_funcionario')
   ->select('disciplina_id')
   ->join('funcionarios', 'funcionarios.id', 'disciplina_funcionario.funcionario_id')
   ->join('disciplinas', 'disciplinas.id', 'disciplina_funcionario.disciplina_id')
   ->where('funcionarios.id', $id)
   ->get();                


        foreach ($user_funcionario as $user) {
            $usuario = User::findOrFail($user->id);
                        foreach ($query4 as $disc) {
            $funcionario->disciplinas()->detach($disc->disciplina_id);
              foreach ($classe_dados as $dados) {
               $funcionario->cursos()->detach($dados->curso_id, ['classe_id' => $dados->classe_id, 'turma_id' => $dados->turma_id]);  

                        $funcionario->delete();
                        $usuario->delete();  
                        return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Funcionario Eliminado com sucesso!');
                        }
                    }
                }
                
                }else{

            foreach ($user_funcionario as $user) {
            $usuario = User::findOrFail($user->id);
                    $funcionario->delete();
                    $usuario->delete(); 
                    return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Funcionario Eliminado com sucesso!');
}
                }
    }


//delete turmas
public function delete_turm($id){
    DB::table('classe_curso_disciplina_funcionario_turma')
       ->where('id', $id)->delete();

   return redirect('/pcaadmin/gerenfuncionarios')->with('msg', 'Alterações feitas com sucesso');

}


}
