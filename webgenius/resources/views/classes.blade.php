<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        @if(@session('msg'))
                <h1>{{session('msg')}}</h1>
        @endif
    </main>
    <form action="/pcaadmin/classes" method="post">
        @csrf
        @method('POST')
                <label>
                    Nome da classe
                    <input type="text" name="nome_classe" id="curso" placeholder="Digite a classe">
                </label>

                <input type="submit" value="Cadastrar">

    </form>
</body>
</html>