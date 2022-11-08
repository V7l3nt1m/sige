@extends('layouts.layoutsige')

@section('title', 'SIGE')

@section('nome_aluno')
<div class="user__name">{{$user->name}}</div>@endsection

@section('settings')
<a class="dropdown-item" href="/sige/definições">Configurações</a>
@endsection

@section('navbar')
<li class="navigation__sub @@variantsactive">
    <a href="#"><i class="zmdi zmdi-book"></i> Escolas</a>

    <ul>
        <li class="@@sidebaractive"><a href="/sige/cadasescolas">Cadastrar Escolas</a></li>
        <li class="@@sidebaractive"><a href="/sige/escolas">Lista de Escolas</a></li>
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

