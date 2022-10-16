<x-guest-layout>

</x-guest-layout>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link href="/../assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Login #7</title>
  </head>
  <body>
  

    <div id="preloader"></div>

  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="componentes/images/imagem.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
            </div>
           
            
                <x-slot name="logo">
                    <h1 class="logo me-auto"><a href="/">Webgenius</a></h1>
                </x-slot>
        
                <x-jet-validation-errors class="mb-4" />
        
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                    
        
                <form method="POST" action="{{ route('login') }}">
                    @csrf
        
                    <div>
                        <x-jet-label for="Nome de Usuário" value="{{ __('Nome de Usuário') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>
        
                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Palavra-Passe') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>
        
                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Manter sessão iniciada') }}</span>
                            
                        </label>
                        
                        <div class="botao">
                          <x-jet-button>
                            {{ __('Iniciar Sessão') }}
                                                </x-jet-button>
                        </div>
                    </div>
        
                    
                       
                    </div>
                </form>

            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  <div class="branco">

  </div>
  <footer>
    <div id="copyright">
      &copy; Copyright <strong><span>Webgenius</span></strong>. All Rights Reserved
    </div>
  </footer>
  
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
  
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</html>