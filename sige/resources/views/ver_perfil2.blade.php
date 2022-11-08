@extends('layouts.layoutsige')

@section('title', 'Perfil')

@section('nome_aluno')
<div class="user__name">{{$user->name}}</div>
@endsection

@section('settings')
<a class="dropdown-item" href="{{route('ver_perfil2')}}">Ver Perfil</a>
<a class="dropdown-item" href="/pcaadmin/definições">Configurações</a>
@endsection

@section('navbar')
<li class="navigation__sub @@variantsactive">
    <a href="#"><i class="zmdi zmdi-settings"></i> Serviços</a>

    <ul>
        <li class="navigation__sub @@variantsactive">
            <a href="#">Alunos</a>
        <ul>
            <li class="@@sidebaractive"><a href="{{route('cadasaluno')}}">Cadastrar Alunos</a></li>
            <li class="@@boxedactive"><a href="{{route('gerenciaralunos')}}">Gerenciar Alunos</a></li>
        </ul>
    </li>
    <li class="navigation__sub @@variantsactive">
        <a href="#">Funcionários</a>
    <ul>
        <li class="@@sidebaractive"><a href="{{route('funcionario')}}">Cadastrar Funcionários</a></li>
        <li class="@@boxedactive"><a href="/pcaadmin/gerenciarturmas">Gerenciar Funcionários</a></li>
    </ul>
</li>

<li class="navigation__sub @@variantsactive">
    <a href="#">Turmas</a>
<ul>
    <li class="@@sidebaractive"><a href="{{route('turmas')}}">Cadastrar Turmas</a></li>
    <li class="@@boxedactive"><a href="{{route('gerenciarturmas')}}">Gerenciar Turmas</a></li>
</ul>
</li>
<li class="navigation__sub @@variantsactive">
<a href="#">Disciplinas</a>
<ul>
<li class="@@sidebaractive"><a href="{{route('disciplinas')}}">Cadastrar Disciplinas</a></li>
<li class="@@boxedactive"><a href="#">Gerenciar Disciplinas</a></li>
</ul>
</li>

<li class="navigation__sub @@variantsactive">
<a href="#">Classes</a>
<ul>
<li class="@@sidebaractive"><a href="{{route('classes')}}">Cadastrar Classes</a></li>
<li class="@@boxedactive"><a href="{{route('funcionario')}}">Gerenciar Classes</a></li>
</ul>
</li>
<li class="navigation__sub @@variantsactive">
<a href="#">Cursos</a>
<ul>
<li class="@@sidebaractive"><a href="{{route('cursos')}}">Cadastrar Cursos</a></li>
<li class="@@boxedactive"><a href="{{route('funcionario')}}">Gerenciar Cursos</a></li>
</ul>
</li>
        </ul>
</li>

<li class="@@typeactive"><a href="#"><i class="zmdi zmdi-money"></i> Finança</a></li>

<li class="@@widgetactive"><a href="#"><i class="zmdi zmdi-money-box"></i> Despesas</a></li>


<li class="@@widgetactive"><a href="{{route('permissoes')}}"><i class="zmdi zmdi-lock"></i></i> Permissões</a></li>

<li class="@@widgetactive"><a href="widgets.html"><i class="zmdi zmdi-account"></i> Livros de Ponto</a></li>


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
                            @foreach ($funcionarios as $funcionario)
                                
                            
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
            @endforeach
      
                <br>
                <br>

                
            </div>
          </div>
      </div>
   
       
    
            </div>
        </div>
    </div>


@endsection



