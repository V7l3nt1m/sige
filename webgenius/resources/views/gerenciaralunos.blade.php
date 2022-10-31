@extends('PCA_admin')

@section('title', 'Admin')

@section('content')

      <main>
        @if(session('msg'))
          <h1 style="font-size: 18px;
          background-color: #d4edda;
          width: 100%;
          border: 1px solid #c3e6cb;
          text-align: center;
          color: #155724;
          font-style: italic;
          margin-bottom: 0;
          padding: 10px;">
            {{session('msg')}}
          </h1>
      @endif

      </main>

      <div class="card">
        <div class="card-body">
            <h2 class="titulo" align="center">Gerenciar Alunos</h2>
<br>
            <h3>Pesquise por Alunos na barra de pesquisa</h3>

    @if($search)
    <h3>Procurando por: {{$search}}</h3>
    <br>
    @if(count($alunos) == 0)
    <p><i>Não há registros</i></p>
    @else
    <div class="table-responsive">
        <table style="color: white" class="table table-inverse">
            <thead class="thead-default">
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
                
            </thead>

            @foreach ($alunos as $aluno)

            <tbody class="table-striped">
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
                    <td>
                <button class="btn btn-light btn-sm" title="Actualizar informações do aluno" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-refresh"></i></button>
                <button class="btn btn-light btn-sm" title="Eliminar registro do aluno" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-close"></i></button>
                    </td>
                </tr>
            </tbody>
            @endforeach
            
           </table>
    </div>
    @endif
    @endif

   
    <br>
   
    </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="/pcaadmin/alunos" method="get">
                <h2>Pesquise alunos por filtro</h2>
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <select name="curso" id="" required class="form-select btn-dark">
                        <option value="" selected disabled>Curso</option>
                            @foreach ($cursos as $curso)
                                    <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-4">
                    <select name="classe" id="" required class="form-select btn-dark">
                        <option value="" selected disabled>Classe</option>
                     @foreach ($classes as $classe)
                        <option value="{{$classe->nome_classe}}">{{$classe->nome_classe}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-4">
                    <select name="turma" id="" required class="form-select btn-dark">
                        <option value="" selected disabled>Turma</option>
                        @foreach ($turmas as $turma)
                        <option value="{{$turma->nome_turma}}">{{$turma->nome_turma}}</option>
                            @endforeach
                    </select>
                </div>
                 <div class="col-md-3"><input type="submit" value="pesquisar" class="btn btn-outline-success"></div>
            </div>
        </form>
    
        <br>
        <br>
                
                @if($query1)
                <h3>Curso: {{$curso_busca}} => Classe: {{$classe_busca}} => Turma: {{$turma_busca}}</h3>
                @if(count($query1) == 0)
                <p><i>Não há registros</i></p>
                @else
                <div class="table-responsive">
                    <table style="color: white" class="table table-inverse">

                        <thead class="thead-default">
                            <th>Nº Processo</th>
                            <th>Nome</th>
                            <th>Nascimento</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Genero</th>
                            <th>Acções</th>
                        </thead>
                        @foreach ($query1 as $aluno)
                        <tbody>
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
                               <td>
                                    <button class="btn btn-light btn-sm" title="Actualizar informações do aluno" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-refresh"></i></button>
                                    <button class="btn btn-light btn-sm" title="Eliminar registro do aluno" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-close"></i></button>
                                        </td>
                            </tr>
                        </tbody>
                        @endforeach
                        
                                   </table>
                </div>
                @endif
                @endif
        </div>
    </div>
@endsection