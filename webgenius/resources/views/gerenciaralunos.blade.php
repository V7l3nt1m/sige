<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/pcaadmin/alunos" method="get">
        <input type="text" name="search" id="procurar" class="form-control" placeholder="Pesquise por algum aluno pelo nome" style="width: 280px">
    </form>
    @if($search)
    <h1>Procurando por {{$search}}</h1>
    @if(count($alunos) == 0)
    <p><i>Não há registros</i></p>
    @else
    <table border="2">
        <tr>
            <th>Nº Processo</th>
            <th>Nome</th>
            <th>Nascimento</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Genero</th>
            <th>Turma</th>
            <th>Curso</th>
            <th>Classe</th>
            <th>Acções</th>
        </tr>

        @foreach ($alunos as $aluno)

        <tr>
            <td>
                {{$aluno->num_processo}}
            </td>
            <td>
                {{$aluno->nome_aluno}}
            </td>
            <td>
                {{$aluno->data_nasc}}
            </td>
            <td>{{$aluno->email_aluno}}</td>
            <td>{{$aluno->telefone_aluno}}</td>
            <td>{{$aluno->genero}}</td>
            <td>{{$aluno->nome_turma}}</td>
            <td>{{$aluno->nome_curso}}</td>
            <td>{{$aluno->nome_classe}}</td>
            <td>Empty</td>
        </tr>
        @endforeach
        
   </table>
    @endif
    @endif

   
    <br>
    <form action="/pcaadmin/alunos" method="get">
            <h2>Pesquise alunos por filtro</h2>
        <select name="curso" id="" required>
            <option value="" selected disabled>Curso</option>
                @foreach ($cursos as $curso)
                        <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                @endforeach
        </select>
        <select name="classe" id="" required>
            <option value="" selected disabled>Classe</option>
         @foreach ($classes as $classe)
            <option value="{{$classe->nome_classe}}">{{$classe->nome_classe}}</option>
    @endforeach
        </select>
        <select name="turma" id="" required>
            <option value="" selected disabled>Turma</option>
            @foreach ($turmas as $turma)
            <option value="{{$turma->nome_turma}}">{{$turma->nome_turma}}</option>
    @endforeach
        </select>
         <input type="submit" value="pesquisar">
    </form>

    <br>
            
            @if($query1)
            <h3>Curso: {{$curso_busca}} => Classe: {{$classe_busca}} => Turma: {{$turma_busca}}</h3>
            @if(count($query1) == 0)
            <p><i>Não há registros</i></p>
            @else
            <table border="2">
                <tr>
                    <th>Nº Processo</th>
                    <th>Nome</th>
                    <th>Nascimento</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Genero</th>
                </tr>
    
                @foreach ($query1 as $aluno)
    
                <tr>
                    <td>
                        {{$aluno->num_processo}}
                    </td>
                    <td>
                        {{$aluno->nome_aluno}}
                    </td>
                    <td>
                        {{$aluno->data_nasc}}
                    </td>
                    <td>{{$aluno->email_aluno}}</td>
                    <td>{{$aluno->telefone_aluno}}</td>
                    <td>{{$aluno->genero}}</td>
                </tr>
                @endforeach
                
           </table>
            @endif
            @endif
            
        
       
   
</body>
</html>