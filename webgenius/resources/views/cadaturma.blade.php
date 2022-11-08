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
      <h2 class="titulo" align="center">Cadastrar Turmas</h2>
<br>


        <div>
          <form action="/pcaadmin/turmas" method="POST">
              @csrf
              @method('POST')
              <div class="row">
                  <div class="col-md-4">
                    <input type="text" class="form-control" id="nome_turma" placeholder="Nome ou ID da turma" name="nome_turma" required="required">
                  </div>
                 
                    <div class="col-md-4">
                      <label for="curso_turma">Associar a um curso</label>
                      <select name="curso_turma" id="curso_turma" class="select2" data-minimum-results-for-search="Infinity">
                        <option selected value="" disabled>Curso</option>
                        @foreach($cursos as $curso)
                        <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                        @endforeach
                      </select>
                        </div>
                        <div class="col-md-4">
                          <br>
                          <br>
                          
                            <label for="classe_turma">Associar a uma classe</label>
                            <select name="classe_turma" id="classe_turma" class="select2" data-minimum-results-for-search="Infinity">
                              <option selected value="" disabled>Classe</option>
                              @foreach($classes as $classe)
                              <option value="{{$classe->nome_classe}}">{{$classe->nome_classe }}</option>
                              @endforeach
                            </select>
                              </div>
              </div>
              <br>
              
              
              <input type="submit" value="Cadastrar" class="btn btn-outline-success">

            
            </form>
        </div>
      </div>

     

    </div>
  </div><!-- End Sales Card -->

@endsection
