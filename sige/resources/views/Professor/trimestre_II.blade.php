@extends('layouts.layoutsige')

@section('title', 'Professor')

@section('nome_aluno')
<div class="user__name">{{$user->name}}</div>
<div class="user__name">{{$user->nome_escola}}</div>
@endsection

@section('settings')
<a class="dropdown-item" href="/professor/perfil">Ver Perfil</a>
<a class="dropdown-item" href="/professor/definições">Configurações</a>
@endsection

@section('navbar')
<li class="@@widgetactive"><a href="/professor"><i class="zmdi zmdi-home"></i></i> Inicio</a></li>
<li class="navigation__sub @@variantsactive">
    <li class="@@widgetactive"><a href="/professor/minhas_turmas"><i class="zmdi zmdi-accounts"></i> Minhas turmas</a></li>
    
    <li class="navigation__sub @@variantsactive">
        <a href="#"><i class="zmdi zmdi-assignment-check"></i> Lançar Notas</a>
    
        <ul>
            <li><a href="/professor/timestreI">I Trimestre</a></li>
            <li><a href="/professor/timestreII">II Trimestre</a></li>
            <li><a href="/professor/timestreIII">III Trimestre</a></li>
            <li><a href="/professor/recurso">Recurso</a></li>
        </ul>
    


</li>
@endsection

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
      @elseif(session('erro'))
      <h1 style="font-size: 18px;
      background-color: red;
      width: 100%;
      border: 1px solid red;
      text-align: center;
      color: white;
      font-style: italic;
      margin-bottom: 0;
      padding: 10px;">
        {{session('erro')}}
      </h1>
  @endif
  
  </main>

<header class="content__title">
    <h1>Lançamento de Notas II Trimestre</h1>
</header>

@foreach ($query_disciplinas as $disciplinas)
<div class="card">
    <div class="card-body">
        <h2 class="titulo" align="center">Disciplina: {{$disciplinas->nome_disc}}</h2>
        @foreach ($query as $dados) 
    <h4>Turma: {{$dados->nome_turma}}</h4>
    <h4>Curso: {{$dados->nome_classe}}</h4>
    <h4>Classe: {{$dados->nome_curso}}</h4>
<br>
<div class="table-responsive">
    <table style="color: white" class="table table-inverse">
        <thead class="thead-default">
                <th>Nº Processo</th>
                <th>Nome</th>
                <th>P1</th>
                <th>P2</th>
                <th>MAC</th>
                <th>MDF I</th> 
                <th>MDF II</th> 
                <th>Acção</th>  
        </thead>

       

        <tbody>
            @foreach($query4 as $aluno)
            @if(strcasecmp($aluno->nome_turma, $dados->nome_turma) == 0 && strcasecmp($aluno->nome_curso, $dados->nome_curso) == 0 && strcasecmp($aluno->nome_classe, $dados->nome_classe) == 0)
            <tr>
                <td>
                    {{$aluno->num_processo}}
                </td>
                <td>
                    {{$aluno->nome_aluno}}
                </td>
                <form action="/professor/trimestreII/nota/{{$aluno->id}}" method="POST">
                    @csrf
                    @method('PUT')
                            <td>
                                    <div class="input-group">
                                        <div class="form-group">
                                          <input type="number" class="form-control" placeholder="P1" name="p1" value="{{$aluno->t2_p1}}">
                                        </div>
                                    </div>
                            </td>
                            <td>
                                    <div class="input-group">
                                        <div class="form-group">
                                          <input type="number" class="form-control" id="p2" placeholder="P2" name="p2" value="{{$aluno->t2_p2}}">
                                        </div>
                                    </div>
                            </td>
                            <td>
                                    <div class="input-group">
                                        <div class="form-group">
                                          <input type="number" class="form-control" id="mac" placeholder="MAC" name="mac" value="{{$aluno->t2_mac}}">
                                        </div>
                                    </div>
                            </td>

                            <td>
                                {{$aluno->t1_mdf}}
                            </td>

                            <td>
                                    {{$aluno->t2_mdf}}
                            </td>
                            <td>
                                    <button type="submit" class="btn btn-light btn-sm" title="Lançar nota" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-check"></i></button>
                                </form> 
                            </td>
            </tr>   
            @endif     
            @endforeach
        </tbody>
       
        
       </table>
       @endforeach
</div>
</div>
@endforeach

@endsection
