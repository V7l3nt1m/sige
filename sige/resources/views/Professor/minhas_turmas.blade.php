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
            <li><a href="#">Recurso</a></li>
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
    <h1>Minhas turmas</h1>
</header>

<div class="card">
    <div class="card-body">
        <h2 class="titulo" align="center">Turmas Associadas</h2>
        @foreach ($query as $dados) 
    <h4>Turma: {{$dados->nome_turma}}</h4>
    <h4>Curso: {{$dados->nome_curso}}</h4>
    <h4>Classe: {{$dados->nome_classe}}</h4>
<br>
<div class="table-responsive">
    <table style="color: white" class="table table-inverse">
        <thead class="thead-default">
                <th>Nº Processo</th>
                <th>Nome</th>
                <th>Nascimento</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Genero</th>   
  
        </thead>

       

        <tbody>
            @foreach($query4 as $aluno)
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
        </tbody>
       
        
       </table>
       @endforeach
</div>
</div>


@endsection
