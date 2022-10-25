@extends('PCA_admin')

@section('title', 'Definições')

@section('content')

<div class="col-xxl-4 col-md-6">
    <div class="card card2">

      <div class="card-body">
        <h4 class="titulo">Alterar informações da conta</h4>
        <div class="container">
            <form action="/pcaadmin/definições/{{$user->id}}" method="POST">
                @csrf
                        @method('PUT') 
          <div class="row">
                        <div class="col-md-4">
                            <label for="nome_usuario">Nome de usuário</label>
                            <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" required="required" value="{{$user->name}}">
                          </div>   
              </div>
              <br>
              <div class="row">
               
                 
              <br>
              <input type="submit" value="Validar" class="btn btn-success">
            </form>
            </div>
          </div>
        </div>
      </div>

     

    </div>
  </div><!-- End Sales Card -->

  <script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  </script>

  <script>
    const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
  </script>

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