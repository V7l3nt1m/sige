<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIGE</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/../componentes/fonts/icomoon/style.css">
    
        <link rel="stylesheet" href="/../componentes/css/owl.carousel.min.css">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/../componentes/css/bootstrap.min.css">
        
        <!-- Style -->
        <link rel="stylesheet" href="/../componentes/css/style.css">
    
        <!-- Fonts -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        <script src="/../componentes/js/jquery-3.3.1.min.js"></script>
        <script src="/../componentes/js/popper.min.js"></script>
        <script src="/../componentes/js/bootstrap.min.js"></script>
        <script src="/../componentes/js/main.js"></script>
    </body>
</html>
