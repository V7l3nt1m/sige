@extends('PCA_admin')

@section('title', 'cadastro_aluno')

@section('content')

<div class="col-xxl-4 col-md-6">
    <div class="card card2">

      

      <div class="card-body">
        <h4 class="titulo">Cadastro de alunos</h4>
        
        <form action="/pcaadmin" enctype="multipart/form-data" method="POST">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-4">
                  <label for="nome">Nome do aluno</label>
                  <input type="text" class="form-control" id="nome_aluno" placeholder="Nome completo do aluno" name="nome_aluno" required="required">
                </div>
                <div class="col-md-4">
                    <label for="processo">Nº de Processo</label>
                    <input type="number" class="form-control" id="processo_aluno" placeholder="Nº de Processo do aluno" name="n_processo" data-toggle="tooltip" data-placement="top" title="O ID de inicio de sessão será o nº de processo do aluno"  required="required">
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
                    <input type="email" class="form-control" id="email_aluno" placeholder="Email do aluno (opcional)" name="email">
                  </div>
                  <div class="col-md-4">
                    <label>Gênero</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="genero_aluno" id="flexRadioDefault1"  required="required" value="feminino">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Masculino
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="genero_aluno" id="flexRadioDefault2"  required="required" value="Feminino">
                        <label class="form-check-label" for="flexRadioDefault2">
                          Feminino
                        </label>
                      </div>
                  </div>
                  <div class="col-md-4">
                    <label for="img">Fotografia</label>
                    <input type="file" name="image" class="form-control" accept="image/*"
                    onchange="updatePreview(this, 'image-preview')"  required="required">
                    <br>
                    
                  </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="exampleInputPassword1">Senha</label>
                    <input type="password" name="senha1" class="form-control" id="exampleInputPassword1" placeholder="Senha" data-toggle="tooltip" data-placement="top" title="A senha será utilizada para o aluno fazer o uso da plataforma"  required="required">
                  </div>
                  <div class="col-md-4">
                      <label for="confsenha">Confirmar senha</label>
                      <input type="password" name="senha2" class="form-control" id="confsenha" placeholder="Confirme a Senha"  required="required">
                    </div>
                    <div class="col-md-4">
                        <label> Previsualização da imagem</label>
                        <br>
                        <img id="image-preview" 
                    style="width:400px"
                    class="img-fluid img-thumbnail" alt="placeholder" >
                    </div>
                    <div class="col">
                        <br>
                        <label for="telefone">Nº de Telefone</label>
                        <input type="number" class="form-control" id="telefone" placeholder="Nº de Telefone do aluno ou dos país" name="telefone"  required="required">
                      </div>
            </div>  
            <br>
            <input type="submit" value="Cadastrar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <!-- Button trigger modal -->

  
  <!-- Modal -->
  
          </form>
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