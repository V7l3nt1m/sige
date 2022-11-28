@extends('layouts.layoutsige')

@section('title', 'Definições')

@section('nome_aluno')
<div class="user__name">{{$user->name}}</div>
@endsection

@section('settings')
<a class="dropdown-item" href="/pcaadmin/perfil">Ver Perfil</a>
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
        <li class="@@boxedactive"><a href="#">Gerenciar Funcionários</a></li>
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
                                 <input type="text" required name="nome_user" class="form-control" placeholder="Nome de usuário" value="{{ $funcionario->nome }}">
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

                </div>
                <div class="row">
                    
                    <div class="col-md-4">
                        <br>
                    <br>
                    <br>
                        <div class="input-group">
                            <input type="file" name="image" class="btn btn-light" accept="image/*"
                            onchange="updatePreview(this, 'image-preview')" onchange="isImagem(this)"  required="required" title="Alterar foto">
                            <button style="margin-left: 20px" class="btn btn-light btn--icon-text" id="sa-success sa-timer" type="submit"><i class="zmdi zmdi-check"></i> Validar</button>
                        </div> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-5">
      <label for="">Previsualização da Imagem</label>
      <img id="image-preview"
      class="img-fluid img-thumbnail rounded mx-auto d-block" alt="placeholder">
    </div>
    <div class="col-md-3"></div>
  </div>
 

<script type="text/javascript">
    function updatePreview(input, target) {
        let file = input.files[0];
        let reader = new FileReader();
        
        reader.readAsDataURL(file);
        reader.onload = function () {
            let img = document.getElementById(target);
            // can also use "this.result"
            img.src = reader.result;
        }
    }
</script>

<script> 
  function validate() {
  var element = document.getElementById('input-field');
  element.value = element.value.replace(/[^a-zA-Zà-úÀ-Úã-õÃ-Õ ]+/, '');
  };
  </script>
  
  <script>
   function isImagem(i){
     
     var img = i.value.split(".");
     var ext = "."+img.pop();
  
     if(!ext.match(/\.(gif|jpg|jpeg|tiff|png)$/i)){
        alert("Não é imagem");
        i.value = '';
        return;
     }
  }
  
  </script>
@endsection
