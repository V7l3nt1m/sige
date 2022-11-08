@extends('layouts.layoutsige')

@section('title', 'Professor')

@section('nome_aluno')
<div class="user__name">{{$user->name}}</div>
@endsection

@section('settings')
<a class="dropdown-item" href="/professor/perfil">Ver Perfil</a>
<a class="dropdown-item" href="/professor/definições">Configurações</a>
@endsection

@section('navbar')
<li class="navigation__sub @@variantsactive">
    <li class="@@widgetactive"><a href="/professor/minhas_turmas"><i class="zmdi zmdi-accounts"></i> Minhas turmas</a></li>
    
    <li class="navigation__sub @@variantsactive">
        <a href="#"><i class="zmdi zmdi-assignment-check"></i> Lançar Notas</a>
    
        <ul>
            <li><a href="#">I Trimestre</a></li>
            <li><a href="#">II Trimestre</a></li>
            <li><a href="#">III Trimestre</a></li>
            <li><a href="#">Exame/Prova Final</a></li>
        </ul>
    
        <a href="#"><i class="zmdi zmdi-assignment-o"></i> Ver Notas Lançadas</a>
        <ul>
            <li><a href="#">I Trimestre</a></li>
            <li><a href="#">II Trimestre</a></li>
            <li><a href="#">III Trimestre</a></li>
            <li><a href="#">Exame/Prova Final</a></li>
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
  @endif

  </main>

<header class="content__title">
    <h1>Minhas turmas</h1>
</header>


<div class="card">
    <div class="card-body">
        <h2 class="titulo" align="center">Turmas Associadas</h2>
<br>
<div class="table-responsive">
    <table style="color: white" class="table table-inverse">
        <thead class="thead-default">
            <th>#</th>
            <th>Turmas</th>
            <th>Classes</th>
            <th>Cursos</th>
            
    
            
            
        </thead>

       

        <tbody>
            @foreach ($query as $dados) 
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$dados->nome_turma}}</td>
                <td>{{$dados->nome_classe}}</td>
                <td>{{$dados->nome_curso}}</td>
            </tr>
            @endforeach
        </tbody>
       
        
       </table>
</div>

@endsection
