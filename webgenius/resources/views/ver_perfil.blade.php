@extends('layouts.layoutsige')

@section('title', 'Aluno')

@section('nome_aluno')
<div class="user__name">{{$nome_aluno}}</div>
@endsection

@section('settings')
<a class="dropdown-item" href="{{route('defi_admin')}}">Configurações</a>
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

        <header class="content__title">
            <h1>perfil</h1>
        </header>
        <h2 align="center">Informações do Aluno</h2>
        <br>
        <br>
        <div class="row">
            <div class="col-md-2">
            
            </div>
            <div class="col-md-3">
                <div class="card-demo">
                    <div class="card">
                        <div class="card-header h5">Foto de Perfil</div>
                        <div class="card-body">
                            <img src="/img/alunos/{{$aluno->imagem_aluno}}" alt="$aluno->imagem_aluno" class="img-thumbnail rounded">
                        </div>
                    </div>
                </div>
                <br>
                <h3 class="card-body__title">Nº de Telefone</h3>
                <div class="form-group">
                    <input class="form-control" disabled placeholder="{{$aluno->telefone_aluno}}">
                </div>
            </div>
            <div class="col-md-1">

            </div>

            <div class="col-md-4">
                
                <h3 class="card-body__title">Nome completo</h3>
                <div class="form-group">
                    <input class="form-control nome_placeholder" disabled placeholder="{{$aluno->nome_aluno}}">
                </div>

                <h3 class="card-body__title">Nº de Processo</h3>
                <div class="form-group">
                    <input class="form-control" disabled placeholder="{{$aluno->num_processo}}">
                </div>

                <h3 class="card-body__title">Data de Nascimento</h3>
                <div class="form-group">
                    <input class="form-control" disabled placeholder="{{date('d/m/Y', strtotime($aluno->data_nasc));}}">
                </div>

                <h3 class="card-body__title">Email</h3>
                <div class="form-group">
                    <input class="form-control" disabled placeholder="{{$aluno->email_aluno}}">
                </div>

                <h3 class="card-body__title">Genero</h3>
                <div class="form-group">
                    <input class="form-control" disabled placeholder="{{$aluno->genero}}">
                </div>
            </div>
        </div>
<br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <h3 class="card-body__title">Curso</h3>
                    <div class="form-group">
                        <input class="form-control" disabled placeholder="{{$dados->nome_curso}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <h3 class="card-body__title">Classe</h3>
                    <div class="form-group">
                        <input class="form-control" disabled placeholder="{{$dados->nome_classe}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <h3 class="card-body__title">Turma</h3>
                    <div class="form-group">
                        <input class="form-control" disabled placeholder="{{$dados->nome_turma}}">
                    </div>
                </div>
                <div class="col-md-1"></div>
                </div>
    
      
                <br>
                <br>

                
            </div>
          </div>
      </div>
   
       
    
            </div>
        </div>
    </div>


@endsection



