<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <div class="" id="cadastroalunos">
    <form action="/pcaadmin/cadasaluno" enctype="multipart/form-data" method="POST" class="form-group">
      @csrf
      @method('POST')
        <div class="row">
          <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon">@</span>
                <div class="form-group">
                    <input type="text" class="form-control" id="input-field" placeholder="Nome do aluno" required="required" name="nome_aluno" onkeyup="validate();">
                    <i class="form-group__bar"></i>
                </div>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon">@</span>
              <div class="form-group">
                <input type="email" class="form-control" id="email_aluno" placeholder="Email do aluno (opcional)" name="email" required="required">
                <i class="form-group__bar"></i>
              </div>
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon">***</span>
            <div class="form-group">
              <input type="number" class="form-control" id="telefone" placeholder="Nº de Telefone do aluno ou dos país" name="telefone"  required="required">
              <i class="form-group__bar"></i>
            </div>
        </div>

        <br>


          </div>
          <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon">#</span>
                <div class="form-group">
                  <input type="number" class="form-control" id="processo_aluno" placeholder="Nº de Processo do aluno" name="n_processo" data-toggle="tooltip" data-placement="top" title="O ID de inicio de sessão será o nº de processo do aluno"  required="required">
                  <i class="form-group__bar"></i>
                </div>
            </div>
            <br>
            <label class="custom-control custom-radio">
              <input id="radio1" name="genero_aluno" type="radio" class="custom-control-input"  required="required" value="Feminino">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">Feminino</span>
          </label>

          <div class="clearfix mb-2"></div>

          <label class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" name="genero_aluno" id="flexRadioDefault1"  required="required" value="Masculino">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">Masculino</span>
          </label>
          </div>
          <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon"></span>
                <div class="form-group">
                  <input type="date" name="data_nasc" class="form-control" id="datanasc_aluno" placeholder="data de nascimento"  required="required">
                  <i class="form-group__bar"></i>
                </div>
            </div>
            <br>
            <div class="input-group">
              <div class="form-group">
                  <input type="file" name="image" class="form-control btn btn-light" accept="image/*" onchange="isImagem(this)"
                  onchange="updatePreview(this, 'image-preview');"  required="required" title="Faça o upload de uma fotografia meio corpo" data-toggle="tooltip" data-placement="top" required="required">
                  <br>
              </div>
          </div>
      <br>
          <div class="form-group">
            <div class="input-group">
              <br>
              <img id="image-preview"
                        style="width:200px"
                        class="img-fluid img-thumbnail" alt="placeholder" >
                        </div>
          </div>
            
                 <select name="nome_turma" id="">
                  <option value="" selected disabled>Turma</option>
                      @foreach($turmas as $turma)
                            <option value="{{$turma->nome_turma}}">{{$turma->nome_turma}}</option>
                      @endforeach
                 </select>
                 <select name="nome_classe" id="">
                  <option value="" selected disabled>Classe</option>
                      @foreach($classes as $classe)
                            <option value="{{$classe->nome_classe}}">{{$classe->nome_classe}}</option>
                      @endforeach
                 </select>
                 <select name="nome_curso" id="">
                  <option value="" selected disabled>Curso</option>
                      @foreach($cursos as $curso)
                            <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                      @endforeach
                 </select>
                 
          </div>
        </div>
        <input type="submit" value="Cadastrar" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal" required="required">

  </form>
  </div>
</div>


</div>
</div>
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
</body>
</html>
   