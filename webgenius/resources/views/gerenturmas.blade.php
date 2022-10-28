<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Gerenciar turmas</h1>

    <form action="pcaadmin/gerenciarturmas" method="GET">
        <select name="turmas" id="">
            <option value="" selected disabled>Turmas</option>
        @foreach ($turmas as $turma)
        <option value="{{$turma->nome_turma}}">{{$turma->nome_turma}}</option>
            @endforeach
        </select>
        <select name="classes" id="">
            <option value="" selected disabled>Classes</option>
            @foreach ($classes as $classe)
            <option value="{{$classe->nome_classe}}">{{$classe->nome_classe}}</option>
                @endforeach
            </select>
            <select name="cursos" id="">
                <option value="" selected disabled>Cursos</option>
                @foreach ($cursos as $curso)
                <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                    @endforeach
                </select>

                <input type="button" value="pesquisar">
    </form>

    <h1>Associar turmas as Classes</h1>
    <form action="/pcaadmin/gerenciarturmas" method="POST">
        @csrf
        @method('POST')
        <select name="nome_turma" id="">
            <option value="" selected disabled>Turmas</option>
        @foreach ($turmas as $turma)
        <option value="{{$turma->nome_turma}}">{{$turma->nome_turma}}</option>
            @endforeach
        </select>
        <select name="nome_classe" id="">
            <option value="" selected disabled>Classe</option>
                @foreach($classes as $classe)
                      <option value="{{$classe->nome_classe}}">{{$classe->nome_classe}}</option>
                @endforeach
           </select>
           <select name="nome_curso" id="">
            <option value="" selected disabled>Curso</option>
                @foreach($cursos as $curso)
                      <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                @endforeach
           </select>
           <input type="submit" value="associar">
    </form>

<br>
    

  

    @if($search)
    <div class="container">
        <h4>Buscando por: {{$search}}</h4>
    @endif

     
</body>
</html>