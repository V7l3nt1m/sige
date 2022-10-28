
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Disciplina</title>
</head>
<body>
  <main>
    @if(session('msg'))
          <h1>{{session('msg')}}</h1>
    @endif
  </main>
  
  <div class="col-xxl-4 col-md-6">
      <div class="card card2">
  
        <div class="card-body">
          <h4 class="titulo">Cadastre uma Disciplina</h4>
          <div class="container text-center">
            <div class="row">
             
              </div>
            </div>
          </div>
          <br>
          
  
  
          <div class="collapse" id="cadastrodedisciplinas">
            <form action="/pcaadmin/disciplinas" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-4">
                      <label for="nome_disciplina">Nome da Disciplina</label>
                      <input type="text" class="form-control" id="nome_disciplina" placeholder="Nome da Disciplina" name="nome_disciplina" required="required">
                    </div>
                      <div class="col-md-4">
                        <label for="curso">Associar a um curso</label>
                        <select name="curso" id="curso_disciplina" class="form-control">
                          <option selected value="" disabled>Curso</option>
                          @foreach ($cursos as $curso)
                          <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                          @endforeach
                        </select>
                          </div>
                          <div class="col-md-4">
                              <label for="classe">Associar a uma classe</label>
                              <select name="classe" id="classe_turma" class="form-control">
                                <option selected value="" disabled>Classe</option>
                              @foreach ($classes as $classe)
                              <option value="{{$classe->nome_classe}}">{{$classe->nome_classe}}</option>
                              @endforeach
                              </select>
                                </div>
                </div>
                <br>
                
                
                <input type="submit" value="Cadastrar" class="btn btn-primary">
  
              
              </form>
          </div>
        </div>
  
       
  
      </div>
    </div><!-- End Sales Card -->
  
  
</body>
</html>

