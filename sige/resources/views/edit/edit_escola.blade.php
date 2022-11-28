@extends('layouts.layoutsige')

@section('title', 'SIGE')

@section('nome_aluno')
<div class="user__name">{{$user->name}}</div>
@endsection

@section('settings')
<a class="dropdown-item" href="/sige/definições">Configurações</a>
@endsection

@section('navbar')
<li class="navigation__sub @@variantsactive">
    <a href="#"><i class="zmdi zmdi-book"></i> Escolas</a>

    <ul>
        <li class="@@sidebaractive"><a href="/sige/cadasescolas">Cadastrar Escolas</a></li>
        <li class="@@sidebaractive"><a href="/sige/listaescolas">Lista de Escolas</a></li>
    </ul>

    <li class="@@typeactive"><a href="#"><i class="zmdi zmdi-money"></i> Finança</a></li>
                        <li class="@@widgetactive"><a href="#"><i class="zmdi zmdi-money-box"></i> Despesas</a></li>
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
  <div class="card">
    <div class="card-body">
        <h2 class="titulo" align="center">Editando Escola: {{$escola->nome_escola}}</h2>
        <br>


<form action="/sige/update/{{$escola->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">

    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <div class="form-group">
                <input type="text" class="form-control"
                id="nome_escola" name="nome_escola" value="{{$escola->nome_escola}}" placeholder="Nome da escola" required>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-addon"><i class="zmdi zmdi-city-alt"></i></span>
            <div class="form-group">
            <input type="city" class="form-control"
            id="city" name="city" placeholder="Cidade" value="{{$escola->cidade}}">
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-addon">Nº</span>
            <div class="form-group">
            <input type="text" class="form-control"
            id="n_registro" name="n_registro" value="{{$escola->n_registro}}" placeholder="Número de registro da escola ">
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <input type="text" class="form-control"
            id="outra_localizacao" name="outra_localizacao" value="{{$escola->outra_localizacao}}" placeholder="Municipio / Bairro / Rua">
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
                <div class="form-group">
                    <input type="number" class="form-control"
                    id="valor_p_aluno" name="valor_p_aluno" value="{{$escola->valor_p_aluno}}" placeholder="valor a pagar por Aluno" required>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon"><i class="zmdi zmdi-dialpad"></i></span>
                <div class="form-group">
                    <input type="text" class="form-control"
                    id="telefone" name="telefone" value="{{$escola->telefone}}" placeholder="Telefone" required>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="email" class="form-control"
                id="email" name="email" placeholder="Digite o Email da Escola" value="{{$escola->email}}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="input-group">  
                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                <div class="form-group">
                    <input type="text" class="form-control"
                    id="bi" name="n_bi" placeholder="Nº do BI" value="{{$escola->n_bi}}" required>
                </div>
        </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">  
            <select name="contrato" id="contrato" class="select2" data-minimum-results-for-search="Infinity" required>
                <option value="" selected disabled>Contrato</option>
                <option value="Anual" {{$escola->contrato == "Anual" ? "selected ='selected'" : ""}}>Anual</option>
                <option value="Trimestral" {{$escola->contrato == "Trimestral" ? "selected ='selected'" : ""}}>Trimestral</option>
                <option value="Semestral" {{$escola->contrato == "Semestral" ? "selected ='selected'" : ""}}>Semestral</option>
            </select>
        </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">  
           <select name="pacote" id="Pacote" class="select2" data-minimum-results-for-search="Infinity" required>
            <option value="" selected disabled>Pacote</option>
            <option value="geral" {{$escola->pacote == "geral" ? "selected ='selected'" : ""}}>Geral</option>
               <option value="Financeiro" {{$escola->pacote == "Financeiro" ? "selected ='selected'" : ""}}>Financeiro</option>
               <option value="Pedagogico" {{$escola->pacote == "Pedagogico" ? "selected ='selected'" : ""}}>Pedagogico</option>
               <option value="Academico" {{$escola->pacote == "Academico" ? "selected ='selected'" : ""}}>Academico</option>
               <option value="Administrativo" {{$escola->pacote == "Administrativo" ? "selected ='selected'" : ""}}>Administrativo</option>
           </select>
       </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="file" name="image" class="form-control" accept="image/*" 
                    onchange="updatePreview(this, 'image-preview')" onchange="isImagem(this)" title="Faça o upload da logo da escola" data-toggle="tooltip" data-placement="top" >
            </div>
        </div>
    </div>

    <div class="row">
        <input type="submit" class="btn btn-dark" value="Cadastrar escola">
    </div>

</div>
</div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5">
          <label for="">Previsualização da Imagem</label>
          <img id="image-preview"
          class="img-fluid img-thumbnail rounded mx-auto d-block" alt="placeholder" src="/img/escolas/{{$escola->logo_escola}}">
        </div>
        <div class="col-md-3"></div>
      </div>
      
</form>

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

