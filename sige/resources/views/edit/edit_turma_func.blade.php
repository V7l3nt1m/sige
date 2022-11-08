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
      border: 1px solid red;
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
        <h2 class="titulo" align="center">Editando Turma ao Professor: {{$funcionario->nome}}</h2>
<br>

<form action="/pcaadmin/update_tur_func/{{$id}}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-4">
          <select name="turma" id="" class="select2" data-minimum-results-for-search="Infinity">
            <option value="" selected disabled>Turma</option>
                @foreach($turmas as $turma)
                      <option value="{{$turma->nome_turma}}" {{$nome_turma == $turma->nome_turma ? "selected='selected'" : ""}}>{{$turma->nome_turma}}</option>
                @endforeach
           </select>
        </div>
         <div class="col-md-4">
           <select name="classe" id="" class="select2" data-minimum-results-for-search="Infinity">
            <option value="" selected disabled>Classe</option>
                @foreach($classes as $classe)
                      <option value="{{$classe->nome_classe}}" {{$nome_classe == $classe->nome_classe ? "selected='selected'" : ""}}>{{$classe->nome_classe}}</option>
                @endforeach
           </select>
         </div>
         <div class="col-md-4">
           <select name="curso" id="" class="select2" data-minimum-results-for-search="Infinity">
            <option value="" selected disabled>Curso</option>
                @foreach($cursos as $curso)
                      <option value="{{$curso->nome_curso}}" {{$nome_curso == $curso->nome_curso ? "selected='selected'" : ""}}>{{$curso->nome_curso}}</option>
                @endforeach
           </select>
         </div>
      </div>
      <br>
    <input type="submit" class="btn btn-success" value="Efectuar Alteração">


</form>


</div>
</div>

@endsection