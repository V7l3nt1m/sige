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
      <h2 class="titulo" align="center">Cadastrar Disciplinas</h2>
<br>
          
  
  
          <div>
            <form action="/pcaadmin/disciplinas" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-4">
                      <input type="text" class="form-control" id="nome_disciplina" placeholder="Nome da Disciplina" name="nome_disciplina" required="required">
                    </div>
                      <div class="col-md-4">
                        <select name="curso" id="curso_disciplina" class="select2" data-minimum-results-for-search="Infinity">
                          <option selected value="" disabled>Curso</option>
                          @foreach ($cursos as $curso)
                          <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                          @endforeach
                        </select>
                          </div>
                          <div class="col-md-4">
                              <select name="classe" id="classe_disciplina" class="select2" data-minimum-results-for-search="Infinity">
                                <option selected value="" disabled>Classe</option>
                              @foreach ($classes as $classe)
                              <option value="{{$classe->nome_classe}}">{{$classe->nome_classe}}</option>
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