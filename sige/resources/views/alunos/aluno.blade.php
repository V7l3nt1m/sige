@extends('layouts.layoutsige')

@section('title', 'Aluno')

@section('nome_aluno')
<div class="user__name">{{$nome_aluno}}</div>
<div class="user__name">{{$user->nome_escola}}</div>
@endsection

@section('img')
<img class="user__img" src="/img/alunos/{{$imagem_aluno}}" alt="{{$imagem_aluno}}">
@endsection


@section('settings')
<a class="dropdown-item" href="{{route('perfil')}}">Perfil</a>
<a class="dropdown-item" href="{{route('settings')}}">Configurações</a>
@endsection

@section('navbar')
<li class="@@widgetactive"><a href="/aluno"><i class="zmdi zmdi-home"></i></i> Inicio</a></li>
<li class="navigation__sub @@variantsactive">
  <a href=""><i class="zmdi zmdi-graduation-cap">
    </i> Informações</a>

    <ul>
      <li class="navigation__sub @@variantsactive">
        <a href="#">Notas</a>
    
        <ul>
            <li><a href="/aluno/timestreI">I Trimestre</a></li>
            <li><a href="/aluno/timestreII">II Trimestre</a></li>
            <li><a href="/aluno/timestreIII">III Trimestre</a></li>
            <li><a href="/aluno/recurso">Recurso</a></li>
        </ul>
</li>
          <li class="@@boxedactive"><a href="#">Finanças</a></li>
      </ul>
  </li>


@endsection



@section('content')

<div style="display: block; padding-top: 130px; opacity: calc(10%);">
  <h1 style="text-align: center; font-size: 80px">
    SIGE
  </h1>
  <br>
  <h2 style="text-align: center; font-size: 60px">Sistema Integrado de Gestão Escolar</h2>
  <img src="/assets/img/ministerio.png" alt="ministerio da educacao" style="width: 100px; display:block; margin: auto;">
</div>
  
@endsection