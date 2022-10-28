<x-guest-layout>

</x-guest-layout>

<!doctype html>
<html lang="en">
  
    <head>
        
        <meta charset="utf-8" />
        <title>SIGE - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/template/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="/template/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/template/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/template/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

         <!-- Vendor CSS Files -->


  <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body class="bg-white">
        <main>
            @if(session('msg'))
                    <h1>{{session('msg')}}</h1>
            @endif
        </main>

        <div class="auth-page d-flex align-items-center min-vh-100">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                            <div class="d-flex flex-column h-100 py-5 px-4">
                                <div class="text-center text-muted mb-2">
                                    <div class="pb-3">
                                        <a href="index.html">
                                            <span class="logo-lg">
                                                 <a href="/"><span class="logo-txt">SIGE</span></a>
                                            </span>
                                        </a>
                                        <p class="text-muted font-size-15 w-75 mx-auto mt-3 mb-0">Sistema Integrado de Gestão Escolar</p>
                                    </div>
                                </div>
        
                                <div class="my-auto">
                                    <div class="p-3 text-center">
                                        <img src="/template/assets/images/auth-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
        
                                <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0" style="color: rgb(55, 81, 126)">© <script>document.write(new Date().getFullYear())</script> Copyright SIGE. All Rights Reserved </p>
                                </div>
                            </div>
                        
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
    
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                        <div class="auth-bg bg-light py-md-5 p-4 d-flex">
                            <div class="bg-overlay-gradient"></div>
                            <!-- end bubble effect -->
                            <div class="row justify-content-center g-0 align-items-center w-100">
                                <div class="col-xl-4 col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="px-3 py-3">
                                                <div class="text-center">
                                                  <x-jet-validation-errors class="mb-4" />
                                                  @if (session('status'))
                                                  <div class="mb-4 font-medium text-sm text-green-600">
                                                      {{ session('status') }}
                                                  </div>
                                              @endif
                                                    <h5 class="mb-0">Bem vindo !</h5>
                                                    <p class="text-muted mt-2">Faça login no SIGE.</p>
                                                </div>
                                                <form class="mt-4 pt-2" method="POST" action="/aluno">
                                                  @csrf
                                                  @method('POST')
                                                    <div class="form-floating form-floating-custom mb-3">
                                                      <x-jet-input id="input-username" class="form-control" placeholder="Id" type="number" name="n_proceso" :value="old('num_processo')" required autofocus />
                                                       <x-jet-label for="input-username" value="{{ __('ID de usuário') }}" />
                                                        <div class="form-floating-icon">
                                                            <i class="bx bxs-user-check"></i>
                                                        </div>
                                                    </div>
                                                    <div class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
                                                       
                                             <x-jet-input id="password-input" placeholder="Palavra-Passe" class="form-control" type="password" name="password" required autocomplete="current-password" />
                                             <x-jet-label for="password-input" value="{{ __('Palavra-Passe') }}" />
                                                        <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                            <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                        </button>
                                                       
                                                        <div class="form-floating-icon">
                                                            <i class="bx bx-key"></i>
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-check-primary font-size-16 py-1">
                                                      
                                                      <label for="remember-check" class="form-check-label font-size-14">
                                                        <x-jet-checkbox class="form-check-input" id="remember-check" name="remember" />
                                                        <span class="ml-2 text-sm text-gray-600">{{ __('Manter sessão iniciada') }}</span>
                                                    </label>

                                                      
                                                        
                                                    </div>
                
                                                    <div class="mt-3">
                                                      <x-jet-button class="btn btn-primary w-100">
                                                        {{ __('Iniciar Sessão') }}
                                                                            </x-jet-button>
                                                          
                                                    </div>
            
                                                    
                                                        
                                                    </div>
            
                
                                                </form><!-- end form -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>
        <!-- end authentication section -->
        <div id="preloader"></div>

        <!-- JAVASCRIPT -->
        <script src="/template/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/template/assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="/template/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/template/assets/libs/feather-icons/feather.min.js"></script>

        <script src="/template/assets/js/pages/pass-addon.init.js"></script>

        <script src="/../assets/vendor/aos/aos.js"></script>
  <script src="/../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/../assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="/../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/../assets/js/main.js"></script>

    </body>
</html>
