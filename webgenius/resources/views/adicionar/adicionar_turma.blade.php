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
        <h2 class="titulo" align="center">Adicionar Turma ao Professor: {{$funcionario->nome}}</h2>
<br>

<form action="/pcaadmin/adicionar/{{$funcionario->id}}" method="POST">
    @csrf
    @method('POST')

    <div class="row">
        <div class="col-md-4">
          <select name="nome_turma" id="" class="form-select btn-dark">
            <option value="" selected disabled>Turma</option>
                @foreach($turmas as $turma)
                      <option value="{{$turma->nome_turma}}">{{$turma->nome_turma}}</option>
                @endforeach
           </select>
        </div>
         <div class="col-md-4">
           <select name="nome_classe" id="" class="form-select btn-dark">
            <option value="" selected disabled>Classe</option>
                @foreach($classes as $classe)
                      <option value="{{$classe->nome_classe}}">{{$classe->nome_classe}}</option>
                @endforeach
           </select>
         </div>
         <div class="col-md-4">
           <select name="nome_curso" id="" class="form-select btn-dark">
            <option value="" selected disabled>Curso</option>
                @foreach($cursos as $curso)
                      <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                @endforeach
           </select>
         </div>
      </div>
      <br>
    <input type="submit" class="btn btn-success" value="Adicionar">


</form>


</div>
</div>

@endsection