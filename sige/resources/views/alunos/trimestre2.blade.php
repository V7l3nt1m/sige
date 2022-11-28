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
<div class="card">
    <div class="card-body">
      <h2 class="titulo" align="center">Trimestre II</h2>

      @foreach ($notas as $nota)
      <div class="row">
        <div class="col-md-4 groups__item">
          <h3>{{$nota->disciplina}}</h3>
<div class="row"> 
  <div class="col-md-6">
    @if($nota->t2_p1 < 10)
    <p class="h4">P1: <span class="text-danger">{{$nota->t2_p1}}</span></p>
    @else
    <p class="h4">P1: <span style="color: black">{{$nota->t2_p1}}</span></p>
    @endif
  </div>
  <div class="col-md-6">
    @if($nota->t2_p2 < 10)
    <p class="h4">P2: <span class="text-danger">{{$nota->t2_p2}}</span></p>
    @else
    <p class="h4">P2: <span style="color: black">{{$nota->t2_p2}}</span></p>
    @endif
  </div>
</div>
<div class="row"> 
  <div class="col-md-6">
    @if($nota->t2_mac < 10)
    <p class="h4">MAC: <span class="text-danger">{{$nota->t2_mac}}</span></p>
    @else
    <p class="h4">MAC: <span style="color: black">{{$nota->t2_mac}}</span></p>
    @endif
  </div>
  <div class="col-md-6">
    @if($nota->t1_mdf < 10)
    <p class="h4">MDF I: <span class="text-danger">{{$nota->t1_mdf}}</span></p>
    @else
    <p class="h4">MDF I: <span style="color: black">{{$nota->t1_mdf}}</span></p>
    @endif
  </div>
</div>
@if($nota->t2_mdf < 10)
<p class="h4">MDF II: <span class="text-danger">{{$nota->t2_mdf}}</span></p>
@else
<p class="h4">MDF II: <span style="color: black">{{$nota->t2_mdf}}</span></p>
@endif
        </div>
      </div>
  @endforeach
      

      
</div>
</div>

  
@endsection