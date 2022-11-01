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
    <a href="#"><i class="zmdi zmdi-accounts"></i> Minhas turmas</a>
    
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
    <h1>Definições</h1>
</header>

<h2 align="center">Alterar Informações de Login</h2>
        <br>
        <br>
        <div class="btn-demo mt-4">

            </div>
        
        <div class="card-demo">
            <div class="card">
                <div class="card-body">
                    <form action="/professor/definições/{{$user->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                     <div class="form-group">
                                         <input type="text" required name="nome_user" class="form-control" placeholder="Nome de usuário" value="{{$funcionario->name}}">
                                         <i class="form-group__bar"></i>
                                     </div>
                                 </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                   <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                                    <div class="form-group">
                                        <input type="password" required name="password1" class="form-control" placeholder="Nova Palavra-Passe">
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                   <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                                    <div class="form-group">
                                        <input type="password" required name="password2" class="form-control" placeholder="Digite Novamente a Palavra-Passe">
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-light btn--icon-text" id="sa-success sa-timer" type="submit"><i class="zmdi zmdi-check"></i> Validar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection