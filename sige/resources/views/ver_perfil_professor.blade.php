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
            <h1>perfil</h1>
        </header>
        <h2 align="center">Informações do Funcionário</h2>
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
                           
                                
                            
                            <img src="/img/funcionarios/{{$funcionario->imagem_fun}}" alt="$funcionario->imagem_fun" class="img-thumbnail rounded">
                        </div>
                    </div>
                </div>
                <br>
                <h3 class="card-body__title">Nº de Telefone</h3>
                <div class="form-group">
                    <input class="form-control" disabled placeholder="{{$funcionario->telefone}}">
                </div>
            </div>
            <div class="col-md-1">

            </div>

            <div class="col-md-4">
                
                <h3 class="card-body__title">Nome completo</h3>
                <div class="form-group">
                    <input class="form-control nome_placeholder" disabled placeholder="{{$funcionario->nome}}">
                </div>

                <h3 class="card-body__title">Função/Permissão</h3>
                <div class="form-group">
                    <input class="form-control" disabled placeholder="{{$funcionario->tipo_fun}}">
                </div>

                <h3 class="card-body__title">Data de Nascimento</h3>
                <div class="form-group">
                    <input class="form-control" disabled placeholder="{{date('d/m/Y', strtotime($funcionario->data_nasc));}}">
                </div>

                <h3 class="card-body__title">Email</h3>
                <div class="form-group">
                    <input class="form-control" disabled placeholder="{{$funcionario->email_fun}}">
                </div>

                <h3 class="card-body__title">Genero</h3>
                <div class="form-group">
                    <input class="form-control" disabled placeholder="{{$funcionario->genero}}">
                </div>
            </div>
        </div>
<br>
         <!--   <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <h3 class="card-body__title">Curso</h3>
                    <div class="form-group">
                        <input class="form-control" disabled placeholder="">
                    </div>
                </div>
                <div class="col-md-3">
                    <h3 class="card-body__title">Classe</h3>
                    <div class="form-group">
                        <input class="form-control" disabled placeholder="">
                    </div>
                </div>
                <div class="col-md-3">
                    <h3 class="card-body__title">Turma</h3>
                    <div class="form-group">
                        <input class="form-control" disabled placeholder="">
                    </div>
                </div>
                <div class="col-md-1"></div>
                </div>
            -->
      
                <br>
                <br>

                
            </div>
          </div>
      </div>
   
       
    
            </div>
        </div>
    </div>


@endsection
