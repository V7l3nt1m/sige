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
<div class="card">
  <div class="card-body">
      <h2 class="titulo" align="center">Cadastrar Classes</h2>
<br>
    <form action="/pcaadmin/classes" method="post">
        @csrf
        @method('POST')
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-book"></i></span>
                            <div class="form-group">
                                <input type="number" class="form-control" id="input-field" placeholder="Nome da classe" required="required" name="nome_classe">
                                <i class="form-group__bar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"><input type="submit" value="Cadastrar" class="btn btn-outline-success"></div>
                </div>

                

    </form>
</div>
</div>


@endsection
