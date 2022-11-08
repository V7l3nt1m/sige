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
    <a href="/professor/minhas_turmas"><i class="zmdi zmdi-accounts"></i> Minhas turmas</a>
    
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
  
    <h3>Dashboard -> Professor</h3>

@endsection