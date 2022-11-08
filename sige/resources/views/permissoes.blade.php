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
    <h2 class="titulo" align="center">Permissoes dos Funcionários</h2>
         
                <div class="table-responsive">
                    @if($search)
                    <div class="container">
                        <br>
                        <h4>Buscando por: {{$search}}</h4>
                    </div>
                    <table style="color: white" class="table table-inverse">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Função/Permissão</th>
                            <th scope="col">Alterar permissoes</th>
                          </tr>
                        </thead>
                        <tbody class="table-striped">
                          @foreach ($funcionarios as $funcionario)
                          <tr>
                           
                            <th scope="row">{{$loop->index+1}}</th>
                            <td>{{$funcionario->nome}}</td>
                            <td>{{$funcionario->telefone}}</td>
                            <form action="/pcaadmin/permissoes/{{$funcionario->id}}" method="POST">
                                     @csrf
                                    @method('PUT')
                            <td>
                              <select name="permissao" id="" required class="select2" data-minimum-results-for-search="Infinity">
                                <option value="" selected disabled> Permissões</option>
                                <option value="professor" {{$funcionario->tipo_fun == "professor" ? "selected='selected'" : ""}}>Professor</option>
                                <option value="tesouraria" {{$funcionario->tipo_fun == "tesouraria" ? "selected='selected'" : ""}}>Tesouraria</option>
                                <option value="pcaadmin" {{$funcionario->tipo_fun == "pcaadmin" ? "selected='selected'" : ""}}>PCA Admin</option>
                                <option value="secretaria" {{$funcionario->tipo_fun == "secretaria" ? "selected='selected'" : ""}}>Secretaria</option>
                            </select>
                            </td>
                            <td>
                              <input type="submit" value="Alterar" class="btn btn-primary">
                                
                            </td>
                            
                                    
                            
                          </tr>
                          @endforeach
                        </tbody>
                        
                      </table>
                    @endif

                    @if($search && count($funcionarios) == 0)
                    <p><i>O Funcionário não foi encontrado</i></p>
                    @endif
                    
                </div>
                <br>
               
                <div>
                    <br>
                    @if(!$search)
                    <div class="table-responsive">
                        <table style="color: white" class="table table-inverse">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Função/Permissão</th>
                                <th scope="col">Alterar permissoes</th>
                              </tr>
                            </thead>
                            <tbody class="table-striped">
                                @foreach ($allfunc as $todosfuncionarios)
                              <tr>
                                <th scope="row">{{$loop->index+1}}</th>
                                <td>{{$todosfuncionarios->nome}}</td>
                                <td>{{$todosfuncionarios->telefone}}</td>
                                <form action="/pcaadmin/permissoes/{{$todosfuncionarios->id}}" method="POST">
                                  @csrf
                                  @method('PUT')
                                <td>
                                  <select name="permissao" id="" required class="select2" data-minimum-results-for-search="Infinity">
                                    <option value="" selected disabled> Permissões</option>
                                    <option value="professor" {{$todosfuncionarios->tipo_fun == "professor" ? "selected='selected'" : ""}}>Professor</option>
                                    <option value="tesouraria" {{$todosfuncionarios->tipo_fun == "tesouraria" ? "selected='selected'" : ""}}>Tesouraria</option>
                                    <option value="pcaadmin" {{$todosfuncionarios->tipo_fun == "pcaadmin" ? "selected='selected'" : ""}}>PCA Admin</option>
                                    <option value="secretaria" {{$todosfuncionarios->tipo_fun == "secretaria" ? "selected='selected'" : ""}}>Secretaria</option>
                                </select>
                                </td>
                                <td>                       
                              <input type="submit" value="Alterar" class="btn btn-primary">      
                                </td>
                              </form>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        @endif
                  </div>
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