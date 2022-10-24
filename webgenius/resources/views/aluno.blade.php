<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>aluno</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<body>
    <h1>Alunos</h1>
    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
        <button class="btn btn-danger">Notificações</button>
        <button class="btn btn-danger">Mensagens</button>
        <form action="/logout" method="POST">
            @csrf
            <a href="/logout"  onclick="event.preventDefault();
            this.closest('form').submit();"> <input type="button" value="fazer logout" class="btn btn-danger">
        </a>
        </form>
    </div>
        
        <div class="container">
        <div>
            <form action="#" method="POST">
                @csrf
        
                    <input type="text" name="search" placeholder="Pesquisar" class="form-control">
            </form>
        </div>
        </div>

        <div>
            <h2>Informações do aluno</h2>
            <h3>Nome do aluno: </h3>
            <h3>Classe: </h3>
            <h3>Turma: </h3>
            <h3>Nº de processo:  </h3>
            <h3>Estado da propina: </h3>
            <button class="btn btn-info">Enviar informações por Email</button>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Vitrine online
              </button>
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                  <p>
                    nota1: ...
                  </p>
                  <p>
                    Estado de aprovação: ...
                  </p>
                </div>
              </div>
              <br>
              <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                Definições
              </button>
              <div class="collapse" id="collapseExample2">
                <div class="card card-body">
                  <p>
                    <h3>Redefina a sua senha do sistema</h3>
                        <div class="form-control">
                                <form action="#" class="form-control">
                                        <label>Senha actual: <input type="password" class="form-control" name="senha_actual"></label>
                                        <label>Nova senha: <input type="password" class="form-control" name="nova_senha"></label>
                                        <label>Confirmar senha: <input type="password" class="form-control" name="confirmar_senha"></label>
                                        <input type="submit" value="Salvar" class="btn btn-info">
                                </form>
                        </div>
                  </p>
                </div>
              </div>
              <br>

              <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                Comentário sobre o professor
              </button>
              <div class="collapse" id="collapseExample3">
                <div class="card card-body">
                  <p>
                    <h3>Faça um comentário sobre algum professor(a)</h3>
                        <div class="form-control">
                                <form action="#" class="form-control">
                                    <select name="professores" class="form-control">
                                        <option value="prof1" disabled selected>Professor(a)</option>
                                        <option value="fa">opcao</option>
                                    </select>
                                    <br>
                                        <textarea name="text" class="form-control" placeholder="Comentário"></textarea>
                                        <input type="submit" value="Fazer comentário" class="btn btn-info"><br>
                                        <i>
                                            <p>Obs: Por favor faça uma critica construtiva ou qualquer outro comentário que tenha o objectivo de melhorar a experiencia com os professores
                                        </i>
                                        </p>
                                </form>
                        </div>
                  </p>
                </div>
              </div>
    
              <div id="preloader"></div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>