<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Aluno</title>
</head>
<body>
  <main>
    @if(session('msg'))
            <h1>{{session('msg')}}</h1>
    @endif
</main>
  <h1>Alunos</h1>
  <form action="/logout" method="POST">
    @csrf
    <a href="/logout" class="dropdown-item"  onclick="event.preventDefault();
    this.closest('form').submit();">Sair
</a>
</form>

  <h3>Acessar notas</h3>
      <p><button type="button">I Trimestre</button> <button type="button">II Trimestre</button> <button type="button">III Trimestre</button></p>
    
      <h3>Informações do Aluno</h3>
       
      <p>Nome: {{$aluno->nome_aluno}}</p>
      
            <p></p>
      <p>Nº de Processo: {{$aluno->num_processo}}</p>
      <p>Data de Nascimento: {{$aluno->data_nasc}}</p>
            <p>Email: {{$aluno->email_aluno}}</p>
            <p>Telefone: {{$aluno->telefone_aluno}}</p>
            <p>Genero: {{$aluno->genero}}</p>

      <h2>Alterar a Senha de Login</h2>
      <form action="/aluno/{{$aluno->id}}" method="POST">
        @csrf
        @method('PUT')
          <label>Digite a nova senha <input type="password" name="password1"></label><br>
          <label>Digite Novamente a senha <input type="password" name="password2"></label><br>
          <input type="submit" value="Validar">
</form>
</body>
</html>