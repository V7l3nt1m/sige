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
  

@endsection