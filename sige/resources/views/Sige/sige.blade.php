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
 
  @if(str_contains($pagina_anterior, "login") == 1)
  <div class="modal" id="modal">
    <div class="modal__container">
        <h2 style="color: black">Bem-Vindo(a)</h2>
        <h3 style="color: black">{{$user->name}}</h3>
    </div>
</div>
@endif

<div style="display: block; padding-top: 130px; opacity: calc(10%);">
  <h1 style="text-align: center; font-size: 80px">
    SIGE
  </h1>
  <br>
  <h2 style="text-align: center; font-size: 60px">Sistema Integrado de Gestão Escolar</h2>
  <img src="/assets/img/ministerio.png" alt="ministerio da educacao" style="width: 100px; display:block; margin: auto;">
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


 <script type="text/javascript">
const modal = document.getElementById("modal");
const btnSkip = document.getElementById("modal-skip");

window.onload = (event) => {
setTimeout(() => modal.classList.add("modal-visible"), 300);
setTimeout(() => modal.classList.remove("modal-visible"), 2000);
};
   </script>
@endsection

