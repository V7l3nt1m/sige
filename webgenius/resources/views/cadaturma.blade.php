@extends('PCA_admin')

@section('title', 'cadastro de turmas')

@section('content')

<div class="col-xxl-4 col-md-6">
    <div class="card card2">

      <div class="card-body">
        <h4 class="titulo">Gestão de Turmas</h4>
        <div class="container text-center">
          <div class="row">
            <div class="col">
              <button class="btn btn-primary btn-lg" type="button" data-bs-toggle="collapse" data-bs-target="#cadastrodeturmas" aria-expanded="false" aria-controls="collapseExample">
                <i class="bi bi-person-plus"></i>
                Cadastro de Turmas
              </button>
          
            </div>
            <div class="col">
              <button class="btn btn-success btn-lg" type="button" data-bs-toggle="collapse" data-bs-target="#gestadeturmas" aria-expanded="false" aria-controls="collapseExample">

                <i class="bi bi-people"></i>
                Gestão de Turmas
              </button>
            </div>
          </div>
        </div>
        <br>
        <div class="collapse" id="gestadeturmas">
          <form action="/pcaadmin/turmas" method="GET">
            <input type="text" name="search3" id="procurar3" class="form-control" placeholder="Pesquise por turmas">
          </form>
          
        </div>


        <div class="collapse" id="cadastrodeturmas">
          <form action="/pcaadmin/turmas" method="POST">
              @csrf
              @method('POST')
              <div class="row">
                  <div class="col-md-4">
                    <label for="nome_turma">Nome ou ID da turma</label>
                    <input type="text" class="form-control" id="nome_turma" placeholder="Nome ou ID da turma" name="nome_turma" required="required">
                  </div>
                 
                    <div class="col-md-4">
                      <label for="curso_turma">Associar a um curso</label>
                      <select name="curso_turma" id="curso_turma" class="form-control">
                        <option selected value="" disabled>Curso</option>
                        <option value="">curso1</option>
                      </select>
                        </div>
                        <div class="col-md-4">
                            <label for="classe_turma">Associar a uma classe</label>
                            <select name="classe_turma" id="classe_turma" class="form-control">
                              <option selected value="" disabled>Classe</option>
                              <option value="">classe1</option>
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

@endsection