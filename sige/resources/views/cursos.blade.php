
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
      <h2 class="titulo" align="center">Gerenciar Cursos</h2>
<br>

          <form action="/pcaadmin/cursos" method="POST">
              @csrf
              @method('POST')
              <div class="row">
                  <div class="col-md-4">
                    <input type="text" class="form-control" id="nome_curso" placeholder="Nome do Curso" name="nome_curso" required="required">
                  </div>
                  
                  <div class="col-md-6">
                    <input type="submit" value="Cadastrar" class="btn btn-outline-success">
                  </div>
                 
                    
              </div>
              <br>
              
              
              

            
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

</div>
</div>

@endsection

