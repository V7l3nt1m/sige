@extends('layouts.layoutsige')

@section('title', 'SIGE')

@section('nome_aluno')
<div class="user__name">{{$user->name}}</div>
@endsection

@section('search')
<form method="GET" action="/sige/listaescolas" class="search">
    <div class="search__inner">
        <input type="text" name="search" class="search__text" placeholder="Pesquise por escolas, contrato ou pacotes...">
        <i class="zmdi zmdi-search search__helper" data-sa-action="search-close"></i>
    </div>
</form>
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
  @if($search)
  <div class="card">
    <div class="card-body">
        <h4 class="titulo">Buscando por: {{$search}}</h2>
            <br>
            @if(count($escolas) == 0)
            <p><i>Não há registros</i></p>
            @else
            <div class="table-responsive">
                <table style="color: white" class="table table-inverse table-sm">
                    <thead class="thead-default">
                        <th>#</th>
                        <th>Nome da Escola</th>
                        <th>Nº de registro</th>
                        <th>Email</th>
                        <th>Contrato</th>
                        <th>Pacote</th>
                        <th>Valor por aluno</th>
                        <th>Telefone</th>
                        <th>BI</th>
                        <th>Cidade</th>
                        <th>Municipio/Bairro/Rua</th>
                        <th>Acções</th>
                        
                    </thead>
            
                    @foreach ($escolas as $escola)
                    
            
                    <tbody class="table-striped">
                        <tr>
                            <td>
                                {{$loop->index+1}}
                            </td>
                            <td>
                                {{$escola->nome_escola}}
                            </td>
                            <td>
                                {{$escola->n_registro}}
                            </td>
                            <td>{{$escola->email}}</td>
                            <td>{{$escola->contrato}}</td>
                            <td>{{$escola->pacote}}</td>
                            <td>{{$escola->valor_p_aluno}}</td>
                            <td>{{$escola->telefone}}</td>
                            <td>{{$escola->n_bi}}</td>
                            <td>{{$escola->cidade}}</td>
                            <td>{{$escola->outra_localizacao}}</td>
                            <td class="input-group">
                                <a href="/sige/edit_escola/{{$escola->id}}" class="btn btn-light btn-sm" title="Actualizar informações da Escola" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-refresh"></i></a>
                                <form action="/sige/listaescolas/{{$escola->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm" title="Eliminar registro da Escola" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-close"></i></button>
                                </form>
                    
                                    </td>
                        </tr>
                    </tbody>
                    @endforeach
                    
                   </table>
            </div>

            @endif
            @endif

    </div>
    </div>

     
 <div class="lista_escolas">
    <div class="card">
        <div class="card-body">
            <h2 class="titulo" align="center">Lista de Escolas</h2>
            <br>
    
            <div class="table-responsive">
                <table style="color: white" class="table table-inverse table-sm">
                    <thead class="thead-default">
                        <th>#</th>
                        <th>Nome da Escola</th>
                        <th>Nº de registro</th>
                        <th>Email</th>
                        <th>Contrato</th>
                        <th>Pacote</th>
                        <th>Valor por aluno</th>
                        <th>Telefone</th>
                        <th>BI</th>
                        <th>Cidade</th>
                        <th>Municipio/Bairro/Rua</th>
                        <th>Acções</th>
                        
                    </thead>
            
                    @foreach ($escolas2 as $escola)
                    
            
                    <tbody class="table-striped">
                        <tr>
                            <td>
                                {{$loop->index+1}}
                            </td>
                            <td>
                                {{$escola->nome_escola}}
                            </td>
                            <td>
                                {{$escola->n_registro}}
                            </td>
                            <td>{{$escola->email}}</td>
                            <td>{{$escola->contrato}}</td>
                            <td>{{$escola->pacote}}</td>
                            <td>{{$escola->valor_p_aluno}}</td>
                            <td>{{$escola->telefone}}</td>
                            <td>{{$escola->n_bi}}</td>
                            <td>{{$escola->cidade}}</td>
                            <td>{{$escola->outra_localizacao}}</td>
                            <td class="input-group">
                        <a href="/sige/edit_escola/{{$escola->id}}" class="btn btn-light btn-sm" title="Actualizar informações da Escola" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-refresh"></i></a>
                        <form action="/sige/listaescolas/{{$escola->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-light btn-sm" title="Eliminar registro da Escola" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-close"></i></button>
                        </form>
            
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    
                   </table>
            </div>
    
    </div>
    </div>
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

