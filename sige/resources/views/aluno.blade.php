@extends('layouts.layoutsige')

@section('title', 'Aluno')

@section('nome_aluno')
<div class="user__name">{{$nome_aluno}}</div>
@endsection

@section('img')
<img class="user__img" src="/img/alunos/{{$imagem_aluno}}" alt="{{$imagem_aluno}}">
@endsection


@section('settings')
<a class="dropdown-item" href="{{route('perfil')}}">Perfil</a>
<a class="dropdown-item" href="{{route('settings')}}">Configurações</a>
@endsection

@section('navbar')
<li class="navigation__sub @@variantsactive">
  <a href=""><i class="zmdi zmdi-graduation-cap">
    </i> Informações</a>

    <ul>
          <li class="@@sidebaractive"><a href="#">Notas</a></li>
          <li class="@@boxedactive"><a href="#">Finanças</a></li>
      </ul>
  </li>


@endsection



@section('content')


  
@endsection