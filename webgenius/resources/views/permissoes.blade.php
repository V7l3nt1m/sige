@extends('PCA_admin')

@section('title', 'cadastro de funcionarios')

@section('content')

<div class="col-xxl-4 col-md-6">
    <div class="card card2">
      <div class="card-body">
        <h4 class="titulo">Permissoes dos Funcionários</h4>
            <form action="/pcaadmin/permissoes" method="GET">
                <input type="text" name="search" id="procurar" class="form-control" placeholder="Pesquise por algum funcionario">
            </form>
                <div>
                    @if($search)
                    <div class="container">
                        <br>
                        <h4>Buscando por: {{$search}}</h4>
                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Função/Permissão</th>
                            <th scope="col">Alterar permissoes</th>
                          </tr>
                        </thead>
                        <tbody>
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
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Mostrar todos os funcionários
                </button>
                <div class="collapse" id="collapseExample">
                    <br>
                    <div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Função/Permissão</th>
                                <th scope="col">Alterar permissoes</th>
                              </tr>
                            </thead>
                            <tbody>
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