@extends('PCA_admin')

@section('title', 'Cursos')

@section('content')

<div class="col-xxl-4 col-md-6">
    <div class="card card2">

      <div class="card-body">
        <h4 class="titulo">Gestão de Cursos</h4>
        <div class="container text-center">
          <div class="row">
            <div class="col">
              <button class="btn btn-primary btn-lg" type="button" data-bs-toggle="collapse" data-bs-target="#cadastrodecursos" aria-expanded="false" aria-controls="collapseExample">
                <i class="bi bi-person-plus"></i>
                Cadastro de Cursos
              </button>
          
            </div>
            <div class="col">
              <button class="btn btn-success btn-lg" type="button" data-bs-toggle="collapse" data-bs-target="#gestadecursos" aria-expanded="false" aria-controls="collapseExample">

                <i class="bi bi-people"></i>
                Gestão de Cursos
              </button>
            </div>
          </div>
        </div>
        <br>
        <div class="collapse" id="gestadecursos">
          <form action="/pcaadmin/turmas" method="GET">
            <input type="text" name="search4" id="procurar4" class="form-control" placeholder="Pesquise por disciplinas">
          </form>
          
        </div>


        <div class="collapse" id="cadastrodecursos">
          <form action="/pcaadmin/cursos" method="POST">
              @csrf
              @method('POST')
              <div class="row">
                  <div class="col-md-4">
                    <label for="nome_curso">Nome do Curso</label>
                    <input type="text" class="form-control" id="nome_curso" placeholder="Nome do Curso" name="nome_curso" required="required">
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