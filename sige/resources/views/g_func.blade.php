@extends('PCA_admin')

@section('title', 'Admin')

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
      @elseif(session('erro'))
      <h1 style="font-size: 18px;
      background-color: red;
      width: 100%;
      border: 1px solid #c3e6cb;
      text-align: center;
      color: white;
      font-style: italic;
      margin-bottom: 0;
      padding: 10px;">
        {{session('erro')}}
      </h1>
  @endif

  </main>


  <div class="card">
    <div class="card-body">
        <h2 class="titulo" align="center">Gerenciar Funcionarios</h2>
<br>

@if($search)
<h3>Procurando por: {{$search}}</h3>
<br>
@if(count($funcionarios) == 0)
<p><i>Não há registros</i></p>
@else
<div class="table-responsive">
    <table style="color: white" class="table table-inverse">
        <thead class="thead-default">
            <th>#</th>
            <th>Nome</th>
            <th>Nascimento</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Genero</th>
            <th>Função/Permissão</th>
            <th>Acções</th>
            
        </thead>

        @foreach ($funcionarios as $funcionario)

        <tbody class="table-striped">
            <tr>
                <td>
                    {{$funcionario->id}}
                </td>
                <td>
                    {{$funcionario->nome}}
                </td>
                <td>
                    {{$funcionario->data_nasc}}
                </td>
                <td>{{$funcionario->email_fun}}</td>
                <td>{{$funcionario->telefone}}</td>
                <td>{{$funcionario->genero}}</td>
                <td>{{$funcionario->tipo_fun}}</td>
                <td>
           <div class="input-group">
                        
                           <a href="/pcaadmin/edit/{{$funcionario->id}}" class="btn btn-light btn-sm" title="Actualizar informações do funcionario" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-refresh"></i></a>
                           @if(strcasecmp($funcionario->tipo_fun, "professor") == 0)
                           <a href="/pcaadmin/adicionarturma/{{$funcionario->id}}" class="btn btn-light btn-sm" title="Adicionar Turma, Classe, Curso" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-plus"></i></a>
                           @endif
                           <form action="/pcaadmin/gerenfuncionarios/{{$funcionario->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light btn-sm" title="Eliminar registro do funcionario" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-close"></i></button>
                        </form>  
                    </div>

                </td>
            </tr>
        </tbody>
        @endforeach
        
       </table>
</div>

@endif

@else

<div class="table-responsive">
    <table style="color: white" class="table table-inverse">
        <thead class="thead-default">
            <th>#</th>
            <th>Nome</th>
            <th>Nascimento</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Genero</th>
            <th>Função/Permissão</th>
            <th>Acções</th>
            
        </thead>

        @foreach ($funcionarios as $funcionario)

        <tbody class="table-striped">
            <tr>
                <td>
                    {{$funcionario->id}}
                </td>
                <td>
                    {{$funcionario->nome}}
                </td>
                <td>
                    {{$funcionario->data_nasc}}
                </td>
                <td>{{$funcionario->email_fun}}</td>
                <td>{{$funcionario->telefone}}</td>
                <td>{{$funcionario->genero}}</td>
                <td>{{$funcionario->tipo_fun}}</td>
                <td>
            <div class="input-group">
                <a href="/pcaadmin/edit/{{$funcionario->id}}" class="btn btn-light btn-sm" title="Actualizar informações do funcionario" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-refresh"></i></a>
                @if(strcasecmp($funcionario->tipo_fun, "professor") == 0)
                <a href="/pcaadmin/adicionarturma/{{$funcionario->id}}" class="btn btn-light btn-sm" title="Adicionar Turma, Classe, Curso" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-plus"></i></a>
                @endif
                
                <form action="/pcaadmin/gerenfuncionarios/{{$funcionario->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-light btn-sm" title="Eliminar registro do funcionario" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-close"></i></button>
                </form>
            </div>
                </td>
            </tr>
        </tbody>
        @endforeach
        
       </table>
</div>

@endif


</div>
</div>

@endsection