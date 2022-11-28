<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Classe;
use App\Models\Nota;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class ProfUpdateController extends Controller
{
    public function update_professor(Request $request){
        $senha1 = $request->password1;
        $senha2 = $request->password2;
        $user = auth()->user();
        $nome_user = $request->nome_user;
    
            $query2 = DB::table('users')
            ->join('funcionarios', 'users.id', 'funcionarios.user_id')
            ->where('funcionarios.user_id', $request->id)
            ->get();
           
    
           foreach ($query2 as $q2) {
                if(strcasecmp($senha1, $senha2) == 0 && ! Hash::check($senha1, $q2->senha_func)){
                    $senha = Hash::make($senha1);
                   
                    
                   User::where('id', $q2->user_id)
                    ->update(['name' => $nome_user]);
                             
                    User::where('id', $q2->user_id)
                             ->update(['password' => $senha]);
    
                     Funcionario::where('user_id', $request->id)
                    ->update(['nome' => $nome_user]);
    
                     Funcionario::where('user_id', $request->id)
                    ->update(['senha_func' => $senha]);
    
                    
                                      
                    
                    return redirect('/professor/definições')->with('msg', 'Senha alterada com sucesso!'); 
                }
                elseif(strcasecmp($senha1, $senha2) != 0){
                    return redirect('/professor/definições')->with('erro', 'As senhas não coincidem');
                }elseif(Hash::check($senha1, $q2->senha_func)){
                    return redirect('/professor/definições')->with('erro', 'A senha já existe');
                }
                
            }
    
       
    }

    

public function nota_tri_I(Request $request){
    $user = auth()->user();
    $query_disciplinas = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    $query = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
    ->join('alunos', 'classe_curso_disciplina_funcionario_turma.turma_id', 'turmas.id')
    ->where('alunos.id', $request->id)
    ->get();

    if (($request->p1 < 0 || $request->p1 > 20) || (($request->p2 < 0 || $request->p2 > 20)) || ($request->mac < 0 || $request->mac > 20)) {
        return redirect('/professor/timestreI')->with('erro', 'Nota apenas de 0 a 20');
    }else{

    foreach ($query as $disc) {
        Nota::where('aluno_id', $request->id)->update(['t1_p1' => $request->p1]);
        Nota::where('aluno_id', $request->id)->update(['t1_p2' => $request->p2]);
        Nota::where('aluno_id', $request->id)->update(['t1_mac' => $request->mac]);

        if (isset($request->p1) && isset($request->p2) && isset($request->mac)) {
            $media = ($request->p1 + $request->p2 + $request->mac)/3;
            Nota::where('aluno_id', $request->id)->update(['t1_mdf' => round($media)]);
        }
        Nota::where('aluno_id', $request->id)->update(['t1_p1' => $request->p1]);
        Nota::where('aluno_id', $request->id)->update(['t1_p2' => $request->p2]);
        Nota::where('aluno_id', $request->id)->update(['t1_mac' => $request->mac]);

        if (isset($request->p1) && isset($request->p2) && isset($request->mac)) {
            $media = ($request->p1 + $request->p2 + $request->mac)/3;
            Nota::where('aluno_id', $request->id)->update(['t1_mdf' => round($media)]);
        }
        Nota::where('aluno_id', $request->id)->update(['t1_p1' => $request->p1]);
        Nota::where('aluno_id', $request->id)->update(['t1_p2' => $request->p2]);
        Nota::where('aluno_id', $request->id)->update(['t1_mac' => $request->mac]);

        if (isset($request->p1) && isset($request->p2) && isset($request->mac)) {
            $media = ($request->p1 + $request->p2 + $request->mac)/3;
            Nota::where('aluno_id', $request->id)->update(['t1_mdf' => round($media)]);
        }

        return redirect('/professor/timestreI')->with('msg', 'Nota Lançada');
    }
}


}

public function nota_tri_Ii(Request $request){
    $user = auth()->user();
    $query_disciplinas = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    $notas = DB::table('notas')
    ->where('aluno_id', $request->id)
    ->get();

    $query = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
    ->join('alunos', 'classe_curso_disciplina_funcionario_turma.turma_id', 'turmas.id')
    ->where('alunos.id', $request->id)
    ->get();

    if (($request->p1 < 0 || $request->p1 > 20) || (($request->p2 < 0 || $request->p2 > 20)) || ($request->mac < 0 || $request->mac > 20)) {
        return redirect('/professor/timestreII')->with('erro', 'Nota apenas de 0 a 20');
    }else{
        foreach ($query as $disc) {
            Nota::where('aluno_id', $request->id)->update(['t2_p1' => $request->p1]);
            Nota::where('aluno_id', $request->id)->update(['t2_p2' => $request->p2]);
            Nota::where('aluno_id', $request->id)->update(['t2_mac' => $request->mac]);
    
            if (isset($request->p1) && isset($request->p2) && isset($request->mac)) {
                foreach ($notas as $nota) {
                    $media1 = ($request->p1 + $request->p2 + $request->mac)/3;
                    $media = ($media1 + $nota->t1_mdf)/2;
                    Nota::where('aluno_id', $request->id)->update(['t2_mdf' => round($media)]);
                }
            }
    
            return redirect('/professor/timestreII')->with('msg', 'Nota Lançada');
        }
    }
    


}

public function nota_tri_III(Request $request){
    $user = auth()->user();
    $query_disciplinas = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    $query = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
    ->join('alunos', 'classe_curso_disciplina_funcionario_turma.turma_id', 'turmas.id')
    ->where('alunos.id', $request->id)
    ->get();

    $notas = DB::table('notas')
    ->where('aluno_id', $request->id)
    ->get();

    if (($request->p1 < 0 || $request->p1 > 20) || (($request->p2 < 0 || $request->p2 > 20)) || ($request->mac < 0 || $request->mac > 20)) {
        return redirect('/professor/timestreIII')->with('erro', 'Nota apenas de 0 a 20');
    }else{
        foreach ($query as $disc) {
            Nota::where('aluno_id', $request->id)->update(['t3_p1' => $request->p1]);
            Nota::where('aluno_id', $request->id)->update(['t3_pf' => $request->p2]);
            Nota::where('aluno_id', $request->id)->update(['t3_mac' => $request->mac]);
    
            if (isset($request->p1) && isset($request->p2) && isset($request->mac)) {
                foreach ($notas as $nota) {
                $media1 = ($request->p1 + $request->p2 + $request->mac)/3;
                $media = ($media1 + $nota->t2_mdf)/2;
                Nota::where('aluno_id', $request->id)->update(['t3_mdf' => round($media)]);
                
            $aprovado = DB::table('notas')
            ->where('aluno_id', $request->id)
            ->where('t3_mdf', '<', '10')
            ->get();

            if (count($aprovado) == 0) {
                Aluno::where('id', $request->id)->update(['estado_aprovado' => "Apto"]);
            }elseif(count($aprovado) == 2){
                Aluno::where('id', $request->id)->update(['estado_aprovado' => "Apto?"]);
            }else{
                Aluno::where('id', $request->id)->update(['estado_aprovado' => "Não Apto"]);
            }
            }
        }
    
            return redirect('/professor/timestreIII')->with('msg', 'Nota Lançada');
        }
    }
    


}




public function recurso_nota(Request $request){
    $user = auth()->user();
    $query_disciplinas = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('funcionarios', 'funcionarios.id', 'classe_curso_disciplina_funcionario_turma.funcionario_id')
    ->where('funcionarios.user_id', $user->id)
    ->get();

    $query = DB::table('disciplinas')
    ->select('disciplinas.nome_disc')
    ->join('classe_curso_disciplina_funcionario_turma', 'disciplinas.id', 'classe_curso_disciplina_funcionario_turma.disciplina_id')
    ->join('turmas', 'turmas.id', 'classe_curso_disciplina_funcionario_turma.turma_id')
    ->join('alunos', 'classe_curso_disciplina_funcionario_turma.turma_id', 'turmas.id')
    ->where('alunos.id', $request->id)
    ->get();

    $notas = DB::table('notas')
    ->where('aluno_id', $request->id)
    ->get();

    if (($request->p1 < 0 || $request->p1 > 20)) {
        return redirect('/professor/recurso')->with('erro', 'Nota apenas de 0 a 20');
    }else{
        foreach ($query as $disc) {
            Nota::where('aluno_id', $request->id)->update(['recurso' => $request->p1]);
                foreach ($notas as $nota) {
                $media = ($request->p1 + $nota->t3_mdf)/2;
                Nota::where('aluno_id', $request->id)->update(['t3_mdf' => round($media)]);
        }
    
            return redirect('/professor/recurso')->with('msg', 'Nota Lançada');
        }
}

}
}
