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

      <form action="/pcaadmin/update_aluno/{{$aluno->id}}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
    <div class="formulario">
      <div class="card">
          <div class="card-body">
              <h4 class="titulo" align="center">Editando Aluno: {{$aluno->nome_aluno}}</h4>
      <br>
        
         <div class="" id="cadastroalunos">
          <div class="row">
            <div class="col-md-4">
              <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                  <div class="form-group">
                      <input type="text" class="form-control" id="input-field" placeholder="Nome do aluno" required="required" value="{{$aluno->nome_aluno}}" name="nome_aluno" onkeyup="validate();">
                      <i class="form-group__bar"></i>
                  </div>
              </div>
              <br>
              <div class="input-group">
                <span class="input-group-addon">@</i></span>
                <div class="form-group">
                  <input type="email" class="form-control" value="{{$aluno->email_aluno}}" id="email_aluno" placeholder="Email do aluno (opcional)" name="email" required="required">
                  <i class="form-group__bar"></i>
                </div>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon"><i class="zmdi zmdi-dialpad"></i></span>
              <div class="form-group">
                <input type="number" class="form-control" id="telefone" value="{{$aluno->telefone_aluno}}" placeholder="N?? de Telefone do aluno ou dos pa??s" name="telefone"  required="required">
                <i class="form-group__bar"></i>
              </div>
          </div>
          <br>
            </div>
            <div class="col-md-4">
              <div class="input-group">
                  <span class="input-group-addon">#</span>
                  <div class="form-group">
                    <input type="number" class="form-control" id="processo_aluno" value="{{$aluno->num_processo}}" placeholder="N?? de Processo do aluno" name="n_processo" data-toggle="tooltip" data-placement="top" title="O ID de inicio de sess??o ser?? o n?? de processo do aluno"  required="required">
                    <i class="form-group__bar"></i>
                  </div>
              </div>
      
              <br>
              <label class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" name="genero_aluno" id="genero"  value="Feminino" {{$aluno->genero ==  "Feminino" ? 'checked' : ''}}>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">Feminino</span>
            </label>
            <label class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" name="genero_aluno" id="genero" value="Masculino" {{$aluno->genero == "Masculino" ? 'checked' : ''}}>
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">Masculino</span>
          </label>
          <br>
          <br>
          <div class="row">
            <div class="col-md-4">
              <select name="nome_turma" id="" class="select2" data-minimum-results-for-search="Infinity">
                <option value="" selected disabled>Turma</option>
                    @foreach($turmas as $turma)
                          <option value="{{$turma->nome_turma}}" {{$nome_turma == $turma->nome_turma ? "selected='selected'" : ""}}>{{$turma->nome_turma}}</option>
                    @endforeach
               </select>
            </div>
             <div class="col-md-4">
               <select name="nome_classe" id="" class="select2" data-minimum-results-for-search="Infinity">
                <option value="" selected disabled>Classe</option>
                    @foreach($classes as $classe)
                          <option value="{{$classe->nome_classe}}" {{$nome_classe == $classe->nome_classe ? "selected='selected'" : ""}}>{{$classe->nome_classe}}</option>
                    @endforeach
               </select>
             </div>
             <div class="col-md-4">
               <select name="nome_curso" id="" class="select2" data-minimum-results-for-search="Infinity">
                <option value="" selected disabled>Curso</option>
                    @foreach($cursos as $curso)
                          <option value="{{$curso->nome_curso}}" {{$nome_curso == $curso->nome_curso ? "selected='selected'" : ""}}>{{$curso->nome_curso}}</option>
                    @endforeach
               </select>
             </div>
          </div>
      
            </div>
      
            <div class="col-md-4">
              <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                  <div class="form-group">
                    <input type="date" name="data_nasc" class="form-control" value="{{$aluno->data_nasc->format("Y-m-d")}}"  placeholder="data de nascimento"  required="required">
                    <i class="form-group__bar"></i>
                  </div>
              </div>
              <br>
              <div class="input-group">
                <div class="form-group">
                  <input type="file" name="image" class="form-control" accept="image/*"
                  onchange="updatePreview(this, 'image-preview')" onchange="isImagem(this)"  title="Fa??a o upload de uma fotografia meio corpo" data-toggle="tooltip" data-placement="top" >
                    <br>
                </div>
            </div>
        <br>
            </div>
          </div>
      
          <input type="submit" value="Cadastrar" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal" required="required">
            
      
        
        </div>
      
      </div>
      </div>
      
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5">
      <label for="">Previsualiza????o da Imagem</label>
      <img src="/img/alunos/{{$aluno->imagem_aluno}}" id="image-preview"
      class="img-fluid img-thumbnail rounded mx-auto d-block" alt="placeholder">
        </div>
        <div class="col-md-3"></div>
      </div>
      
      <br>
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
element.value = element.value.replace(/[^a-zA-Z??-????-????-????-?? ]+/, '');
};
</script>

<script>
 function isImagem(i){
   
   var img = i.value.split(".");
   var ext = "."+img.pop();

   if(!ext.match(/\.(gif|jpg|jpeg|tiff|png)$/i)){
      alert("N??o ?? imagem");
      i.value = '';
      return;
   }
}

</script>

@endsection