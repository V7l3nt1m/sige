@extends('PCA_admin')

@section('title', 'funcionarios')

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
    @elseif(session('erro'))
    <h1 style="font-size: 18px;
    background-color: red;
    width: 100%;
    border: 1px solid red;
    text-align: center;
    color: white;
    font-style: italic;
    margin-bottom: 0;
    padding: 10px;">
      {{session('erro')}}
    </h1>
@endif

</main>

      <div class="card">
        <div class="card-body">
            <h4 class="titulo" align="center">Editando: {{$funcionario->nome}}</h4>
<br>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <form action="/pcaadmin/update/{{$funcionario->id}}" enctype="multipart/form-data" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                        <div class="form-group">
                          <input type="text" class="form-control" id="input-field" placeholder="Nome completo do funcionário" value="{{$funcionario->nome}}" name="nome_func" required="required" onkeyup="validate();">
                            <i class="form-group__bar"></i>
                        </div>
                    </div> 
                  </div>
                    <br>
                    <br>
                    <br>
                    <div class="col-md-6 col-sm-12">
                      <div class="input-group">
                        <div class="form-group">
                          <select class="select2" data-minimum-results-for-search="Infinity" name="funcao" required="required">
                              <option value="" selected disabled>Função/Permissão</option>
                              <option value="tesouraria" {{$funcionario->tipo_fun == "tesouraria" ? "selected='selected'" : ""}}>Tesouraria</option>
                              <option value="secretaria" {{$funcionario->tipo_fun == "secretaria" ? "selected='selected'" : ""}}>Secretaria</option>
                              <option value="professor" {{$funcionario->tipo_fun == "professor" ? "selected='selected'" : ""}}>Professor</option>
                              <option value="pcaadmin" {{$funcionario->tipo_fun == "pcaadmin" ? "selected='selected'" : ""}}>PCA Admin</option>
                          </select>
                            <i class="form-group__bar"></i>
                        </div>
                                        </div>
                    </div>
                  <br>
                </div>
                <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <div class="input-group">
                      <span class="input-group-addon">@</span>
                      <div class="form-group">
                        <input type="email" class="form-control" id="email_func" value="{{$funcionario->email_fun}}" placeholder="Email do funcionário" name="email" required>
                          <i class="form-group__bar"></i>
                      </div>
                  </div>
                </div>

              
             
          <div class="col-md-4 col-sm-12">
  <div class="input-group">
    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
    <div class="form-group">
      <input type="date" name="data_nasc" class="form-control" id="datanasc_aluno" value="{{$funcionario->data_nasc->format("Y-m-d")}}" placeholder="Data de nascimento"  required="required">
        <i class="form-group__bar"></i>
    </div>
</div>
</div>
  <div class="col-md-4 col-sm-12">
              <div class="input-group">
                <span class="input-group-addon"><i class="zmdi zmdi-dialpad"></i></span>
                <div class="form-group">
                  <input type="number" class="form-control" id="telefone" value="{{$funcionario->telefone}}" placeholder="Nº de Telefone do funcionário" name="telefone"  required="required">
                  <i class="form-group__bar"></i>
                </div>
            </div>
            </div>

       
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                <label for="">Fotográfia meio corpo</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-12">
                <input type="file" name="image" class="btn btn-light" accept="image/*" 
                onchange="updatePreview(this, 'image-preview')" onchange="isImagem(this)">
                <br>
               </div>

                   <div class="col-md-4">
                <label class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="genero_func" id="genero"  required="required" value="Feminino" {{$funcionario->genero ==  "Feminino" ? 'checked' : ''}}>
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description">Feminino</span>
              </label>
              <label class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" name="genero_func" id="genero"  required="required" value="Masculino" {{$funcionario->genero ==  "Masculino" ? 'checked' : ''}}>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">Masculino</span>
            </label>
          </div>
               
            </div>
                  </div>
                </div>

              </div>
              
            </div>
        </div>
    </div>

    <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Professor
  </button>
              
                    
  <div class="collapse" id="collapseExample">
    <hr>
    <div class="card card-body">
        <h4>Alterar Disciplina do Professor</h4>
        <div class="col-md-3">
            <div class="form-group">
                  <select class="select2" data-minimum-results-for-search="Infinity" name="disciplina">
                      <option value="" selected disabled>Disciplina</option>
                      @foreach ($disciplinas as $disciplina)
                      <option value="{{$disciplina->nome_disc}}" {{$nome_disciplina == $disciplina->nome_disc ? "selected='selected'" : ""}}>{{$disciplina->nome_disc}}</option>
                  @endforeach
                  </select>
                </div>
          </div>
        </div>
        <p>Obs: Selecionar apenas se o funcionário for Professor</p>


    <div class="card card-body">
      <h4>Alterar Turmas Cadastradas</h4>

        <div class="table-responsive">
            <table style="color: white" class="table table-inverse table-sm">
                    <thead class="thead-default">
                        <th>#</th>
                        <th>Turma</th>
                        <th>Classe</th>
                        <th>Curso</th>
                    </thead>
                    <tbody>
                        @foreach ($query1 as $index => $nada) 
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>
                    <div class="select">
                        <select class="select2" data-minimum-results-for-search="Infinity" name="turma">
                            <option value="" selected disabled>Turma</option>
                            @foreach ($turmas as $turma)
                            <option value="{{$turma->nome_turma}}" {{$query3[$index]->nome_turma == $turma->nome_turma ? "selected='selected'" : ""}}>{{$turma->nome_turma}}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>
                    <div class="select">
                        <select class="select2" data-minimum-results-for-search="Infinity" name="classe">
                            <option value="" selected disabled>Classe</option>
                            @foreach ($classes as $classe)
                            <option value="{{$classe->nome_classe}}" {{$query1[$index]->nome_classe == $classe->nome_classe ? "selected='selected'" : ""}}>{{$classe->nome_classe}}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>
                    <div class="select">
                        <select class="select2" data-minimum-results-for-search="Infinity" name="curso">
                            <option value="" selected disabled>Curso</option>
                            @foreach ($cursos as $curso)
                            <option value="{{$curso->nome_curso}}" {{$query2[$index]->nome_curso == $curso->nome_curso ? "selected='selected'" : ""}}>{{$curso->nome_curso}}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
            </tr>
            @endforeach
                        
                    </tbody>
            </table>
        </div>
     
    </div>
</div>
<input type="submit" value="Alterar" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          
               </div>
                 
                </div>
                <br>
                
                <br>
                <!-- Button trigger modal -->
            
            
              <!-- Modal -->
              </form>
          </div>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5">
              <label for="">Previsualização da Imagem</label>
              <img src="/img/funcionarios/{{$funcionario->imagem_fun}}" id="image-preview"
              class="img-fluid img-thumbnail rounded mx-auto d-block" alt="placeholder">
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
      </div>

     

 <!-- End Sales Card -->
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
    function validate2() {
    var element = document.getElementById('input-field2');
  element.value = element.value.replace(/[^a-zA-Zà-úÀ-Úã-õÃ-Õ]+/, '');
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
