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
  @endif
</main>

  <div class="card">
    <div class="card-body">
        <h2 class="titulo" align="center">Turmas Cadastradas</h2>
<br>
<div class="table-responsive">
    <table style="color: white" class="table table-inverse">
        <thead class="thead-default">
            <th>#</th>
            <th>Turma</th>
            <th>Acções</th>
            
        </thead>

        @foreach ($turmas as $turma)
        

        <tbody class="table-striped">
            <tr>
                <td>
                    {{$loop->index+1}}
                </td>
                <td>
                    {{$turma->nome_turma}}
                </td>
                <td>
            <button class="btn btn-light btn-sm" title="Actualizar informações de Associação" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-refresh"></i></button>
            <button class="btn btn-light btn-sm" title="Eliminar registro da Associação" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-close"></i></button>

                </td>
            </tr>
        </tbody>
        @endforeach
        
       </table>

</div>
</div>


  <div class="card">
    <div class="card-body">
        <h2 class="titulo" align="center">Gerenciar Turmas</h2>
  <br>

  <div class="table-responsive">
    <table style="color: white" class="table table-inverse">
        <thead class="thead-default">
            <th>#</th>
            <th>Turma</th>
            <th>Classe</th>
            <th>Curso</th>
            <th>Acções</th>
            
        </thead>

        @foreach ($query as $dados)
        

        <tbody class="table-striped">
            <tr>
                <td>
                    {{$loop->index+1}}
                </td>
                <td>
                    {{$dados->nome_turma}}
                </td>
                <td>
                    {{$dados->nome_classe}}
                </td>
                <td>{{$dados->nome_curso}}</td>
                <td>
            <button class="btn btn-light btn-sm" title="Actualizar informações de Associação" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-refresh"></i></button>
            <button class="btn btn-light btn-sm" title="Eliminar registro da Associação" data-toggle="tooltip" data-placement="bottom"><i class="zmdi zmdi-close"></i></button>

                </td>
            </tr>
        </tbody>
        @endforeach
        
       </table>
</div>

<div class="card">
    <div class="card-body">
  <br>

    <h3>Associar turmas -> classes -> cursos</h3>
    <br>
    <form action="/pcaadmin/gerenciarturmas" method="POST">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-3">
                <select name="nome_turma" id="" class="form-select btn-dark">
                    <option value="" selected disabled>Turmas</option>
                @foreach ($turmas as $turma)
                <option value="{{$turma->nome_turma}}">{{$turma->nome_turma}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="nome_classe" id="" class="form-select btn-dark">
                    <option value="" selected disabled>Classe</option>
                        @foreach($classes as $classe)
                              <option value="{{$classe->nome_classe}}">{{$classe->nome_classe}}</option>
                        @endforeach
                   </select>
            </div>
               <div class="col-md-3">
                   <select name="nome_curso" id="" class="form-select btn-dark">
                    <option value="" selected disabled>Curso</option>
                        @foreach($cursos as $curso)
                              <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                        @endforeach
                   </select>
               </div>
               <div class="col-md-3"><input type="submit" value="associar" class="btn btn-outline-success"></div>
        </div>
    </form>
</div>
</div>
<br>
    


</div>


</div>
</div>

@endsection