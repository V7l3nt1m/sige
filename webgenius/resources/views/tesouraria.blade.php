<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tesouraria</title>
</head>
<body>
    <form action="/logout" method="POST">
        @csrf
        <a href="/logout"  onclick="event.preventDefault();
        this.closest('form').submit();">sair
    </a>
    </form>
</body>
</html>