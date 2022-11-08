@extends('PCA_admin')

@section('title', 'cadastro de funcionarios')

@section('content')

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
                            <td>{{$funcionario->tipo_fun}}</td>
                            <td>
                                <form action="/pcaadmin/permissoes/{{$funcionario->id}}" method="POST">
                                  @csrf
                                    @method('PUT')
                                    <div class="btn-group" role="group">
                                      <select name="permissao" id="" required>
                                          <option value="" selected disabled> Permissões</option>
                                          <option value="professor">Professor</option>
                                          <option value="tesouraria">tesouraria</option>
                                          <option value="pcaadmin">Admin</option>
                                          <option value="secretaria">secretaria</option>
                                      </select>
                                      <input type="submit" value="Alterar" class="btn btn-primary">
                                    </div>
                                </form>
                                
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
                                <td>{{$todosfuncionarios->tipo_fun}}</td>
                                <td>
                                    <form action="" method="POST">
                                        @method('PUT')
                                        <div class="btn-group" role="group">
                                          <select name="" id="" class="form-control">
                                              <option value="" selected disabled> Permissões</option>
                                          </select>
                                          <input type="submit" value="Alterar" class="btn btn-primary">
                                        </div>
                                    </form>
                                </td>
                                
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