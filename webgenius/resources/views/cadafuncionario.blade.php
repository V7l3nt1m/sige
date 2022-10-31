@extends('PCA_admin')

@section('title', 'cadastro de funcionarios')

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
            <h4 class="titulo" align="center">Cadastro de funcionarios</h4>
<br>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <form action="/pcaadmin/funcionarios" enctype="multipart/form-data" method="POST">
                      @csrf
                      @method('POST')
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                        <div class="form-group">
                          <input type="text" class="form-control" id="input-field" placeholder="Nome completo do funcionário" name="nome_func" required="required" onkeyup="validate();">
                            <i class="form-group__bar"></i>
                        </div>
                    </div> 
                  </div>
                    <br>
                    <br>
                    <br>
                    <div class="col-md-6 col-sm-12">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-settings"></i></span>
                        <div class="form-group">
                          <input type="text" class="form-control" id="input-field" placeholder="Função ou Departamento" name="funcao" required="required" onkeyup="validate();">
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
                        <input type="email" class="form-control" id="email_func" placeholder="Email do funcionário" name="email" required>
                          <i class="form-group__bar"></i>
                      </div>
                  </div>
                </div>

              
             
          <div class="col-md-4 col-sm-12">
  <div class="input-group">
    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
    <div class="form-group">
      <input type="date" name="data_nasc" class="form-control" id="datanasc_aluno" placeholder="Data de nascimento"  required="required">
        <i class="form-group__bar"></i>
    </div>
</div>
</div>
  <div class="col-md-4 col-sm-12">
              <div class="input-group">
                <span class="input-group-addon"><i class="zmdi zmdi-dialpad"></i></span>
                <div class="form-group">
                  <input type="number" class="form-control" id="telefone" placeholder="Nº de Telefone do funcionário" name="telefone"  required="required">
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
                onchange="updatePreview(this, 'image-preview')" onchange="isImagem(this)"  required="required">
                <br>
               </div>

                   <div class="col-md-4">
                <label class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="genero_func" id="genero"  required="required" value="Feminino">
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description">Feminino</span>
              </label>
              <label class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" name="genero_func" id="genero"  required="required" value="Masculino">
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
      <h4>Associar Professor a Turmas, Classes e Cursos</h4>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <div class="select">
                <select class="form-select" name="classe">
                    <option value="" selected disabled>Classe</option>
                    @foreach ($classes as $classe)
                        <option value="{{$classe->nome_classe}}">{{$classe->nome_classe}}</option>
                    @endforeach
                </select>
            </div>
              </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <div class="select">
                <select class="form-select" name="curso">
                    <option value="" selected disabled>Curso</option>
                    @foreach ($cursos as $curso)
                    <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                @endforeach
                </select>
            </div>
              </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <div class="select">
                <select class="form-select" name="turma">
                    <option value="" selected disabled>Turma</option>
                    @foreach ($turmas as $turma)
                    <option value="{{$turma->nome_turma}}">{{$turma->nome_turma}}</option>
                @endforeach
                </select>
            </div>
              </div>
        </div>
      </div>
      <p>Obs: Selecionar apenas se o funcionário for Professor</p>
    </div>
</div>
<input type="submit" value="Cadastrar" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          
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
              <img id="image-preview"
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