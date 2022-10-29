<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Professor</title>
</head>
<body>
    <form action="/logout" method="POST">
        @csrf
        <a href="/logout"  onclick="event.preventDefault();
        this.closest('form').submit();">sair
    </a>
    </form>
    <main>
        @if(session('msg'))
                <h1>{{session('msg')}}</h1>
        @endif
    </main>

    <h3>Lançar notas</h3>
    <p><button type="button">I Trimestre</button> <button type="button">II Trimestre</button> <button type="button">III Trimestre</button></p>
  
    <h3>Informações do Professor</h3>

    <p>Nome: {{$funcionario->nome}}</p>
      
            <p></p>
      <p>Data de Nascimento: {{$funcionario->data_nasc}}</p>
            <p>Email: {{$funcionario->email_fun}}</p>
            <p>Telefone: {{$funcionario->telefone}}</p>
            <p>Genero: {{$funcionario->genero}}</p>

      <h2>Alterar a Senha de Login</h2>
      <form action="/professor/{{$funcionario->id}}" method="POST">
        @csrf
        @method('PUT')
          <label>Digite a nova senha <input type="password" name="password1"></label><br>
          <label>Digite Novamente a senha <input type="password" name="password2"></label><br>
          <input type="submit" value="Validar">
</body>
</html>