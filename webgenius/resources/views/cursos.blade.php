
<div class="col-xxl-4 col-md-6">
    <div class="card card2">

      <div class="card-body">
        <h4 class="titulo">Gestão de Cursos</h4>
        <div class="container text-center">
          <div class="row">
            <div class="col">
              
          
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

@