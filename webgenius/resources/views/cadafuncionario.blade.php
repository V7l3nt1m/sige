@extends('PCA_admin')

@section('title', 'cadastro de funcionarios')

@section('content')

<div class="col-xxl-4 col-md-6">
    <div class="card card2">

      <main>
        @if (session('msg'))
          <h1>
            {{session('msg')}}
          </h1>
      @endif

      </main>

      <div class="card-body">
        <h4 class="titulo">Cadastro de funcionarios</h4>
        
        <div class="row">
          <div class="col-md-9">
            <form action="/pcaadmin/funcionarios" enctype="multipart/form-data" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-4">
                      <label for="nome">Nome do funcionario</label>
                      <input type="text" class="form-control" id="input-field" placeholder="Nome completo do funcionário" name="nome_func" required="required" onkeyup="validate();">
                    </div>
                    <div class="col-md-4">
                        <label for="processo">Função</label>
                        <input type="text" class="form-control" id="input-field" placeholder="Função ou Departamento" name="funcao" required="required" onkeyup="validate();">
                      </div>
                      <div class="col-md-4">
                        <label for="datanasc">Data de nascimento</label>
                        <input type="date" name="data_nasc" class="form-control" id="datanasc_aluno" placeholder="data de nascimento"  required="required">
                      </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email_func" placeholder="Email do funcionário" name="email">
                      </div>
                      <div class="col-md-4">
                        <label>Gênero</label>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="genero_func" id="genero"  required="required" value="feminino">
                            <label class="form-check-label" for="genero">
                              Masculino
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="genero_func" id="genero"  required="required" value="Feminino">
                            <label class="form-check-label" for="genero">
                              Feminino
                            </label>
                          </div>
                      </div>
                      <div class="col-md-4">
                        <label for="img">Fotografia</label>
                        <input type="file" name="image" class="form-control" accept="image/*"
                        onchange="updatePreview(this, 'image-preview')" onchange="isImagem(this)"  required="required">
                        <br>
            
                      </div>
                </div>
                <br>
                <div class="row">
                    
                        <div class="col-md-4">
                          <label for="telefone">Nº de Telefone</label>
                          <input type="number" class="form-control" id="telefone" placeholder="Nº de Telefone do funcionário" name="telefone"  required="required">
                        </div>
                       
                </div>
                <br>
                <input type="submit" value="Cadastrar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <!-- Button trigger modal -->
            
            
              <!-- Modal -->
              </form>
          </div>
          <div class="col-md-3">
            <label> Previsualização da imagem</label>
            <br>
            <img id="image-preview"
        style="width:400px"
        class="img-fluid img-thumbnail" alt="placeholder" >
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

<script> 
  function validate() {
  var element = document.getElementById('input-field');
  element.value = element.value.replace(/[^a-zA-Zà-úÀ-Úã-õÃ-Õ ]+/, '');
  };
  </script>
  
  <script>
   function isImagem(i){
     
     var img = i.value.split(".");
     var ext = "."+img.pop();
  
     if(!ext.match(/\.(gif|jpg|jpeg|tiff|png)$/i)){
        alert("Não é imagem");
        i.value = '';
        return;
     }
  }
  
  </script>

@endsection