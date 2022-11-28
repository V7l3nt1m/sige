@extends('layouts.layoutsige')

@section('title', 'Aluno')

@section('nome_aluno')
<div class="user__name">{{$nome_aluno}}</div>
<div class="user__name">{{$user->nome_escola}}</div>
@endsection

@section('settings')
<a class="dropdown-item" href="{{route('perfil')}}">Perfil</a>
<a class="dropdown-item" href="/alunos/definições">Configurações</a>
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

@if(str_contains($pagina_anterior, "login") == 1)
  <div class="modal" id="modal">
    <div class="modal__container">
        <h2 style="color: black">Bem-Vindo(a)</h2>
        <h3 style="color: black">{{$user->name}}</h3>
    </div>
</div>
@endif

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
                            <img src="/img/alunos/{{$aluno->imagem_aluno}}" alt="$aluno->imagem_aluno" class="img-thumbnail rounded" style="display: block; margin:auto">
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


   <script type="text/javascript">
    const modal = document.getElementById("modal");
   const btnSkip = document.getElementById("modal-skip");
   window.onload = (event) => {
     setTimeout(() => modal.classList.add("modal-visible"), 300);
     setTimeout(() => modal.classList.remove("modal-visible"), 2000);
   };  
          </script>
@endsection



