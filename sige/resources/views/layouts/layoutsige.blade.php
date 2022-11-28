<!DOCTYPE html>
<html lang="en">
    
<!--Designed By ALpha-->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        <!-- Vendor styles -->
        <link rel="stylesheet" href="/template/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="/template/vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="/template/vendors/bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="/template/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="/template/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="/template/css/app.min.css">
        <link rel="stylesheet" href="/template/style.css">
        <link rel="stylesheet" href="/template/modal.css">
        <link rel="stylesheet" href="/template/fundo.css">
    </head>

    <body data-sa-theme="{{$user->background_color}}">
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            <header class="header">
                <div class="navigation-trigger hidden-xl-up" data-sa-action="aside-open" data-sa-target=".sidebar">
                    <i class="zmdi zmdi-menu"></i>
                </div>

                <div class="logo hidden-sm-down">
                    <h1><a href="/">SIGE</a></h1>
                </div>



                @yield('search')
            <!--    <form class="search">
                    <div class="search__inner">
                        <input type="text" class="search__text" placeholder="Search for people, files, documents...">
                        <i class="zmdi zmdi-search search__helper" data-sa-action="search-close"></i>
                    </div>
                </form> -->

                <ul class="top-nav">
                    <li class="hidden-xl-up"><a href="#" data-sa-action="search-open"><i class="zmdi zmdi-search"></i></a></li>

                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="top-nav__notify"><i class="zmdi zmdi-email"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                            <div class="dropdown-header">
                                Mensagens

                                <div class="actions">
                                    <a href="messages.html" class="actions__item zmdi zmdi-plus"></a>
                                </div>
                            </div>

                            <div class="listview listview--hover">
                                <a href="#" class="listview__item">

                                   
                                </a>

                              

                              

                                

                                <a href="#" class="view-more">Ver todas as Mensagens</a>
                            </div>
                        </div>
                    </li>

                    <li class="dropdown top-nav__notifications">
                        <a href="#" data-toggle="dropdown" class="top-nav__notify">
                            <i class="zmdi zmdi-notifications"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                            <div class="dropdown-header">
                                Notificações

                                <div class="actions">
                                    <a href="#" class="actions__item zmdi zmdi-check-all" data-sa-action="notifications-clear"></a>
                                </div>
                            </div>

                            <div class="listview listview--hover">
                                <div class="listview__scroll scrollbar-inner">
                                    <a href="#" class="listview__item">

                                       
                                    </a>

                                  

                                </div>

                                <div class="p-1"></div>
                            </div>
                        </div>
                    </li>

                  

                    

                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item theme-switch">
                                Alterar Cor do Tema
                                <form action="/cor/{{$user->id}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="btn-group btn-group--colors mt-2 d-block" data-toggle="buttons">
                                        @if($user->background_color == 1)
                                        <label class="btn active border-0" style="background-color: #772036;"><input type="radio" name="cor" value="1" autocomplete="off"></label>
                                        @else
                                        <label class="btn border-0" style="background-color: #772036;"><input type="radio" name="cor" value="1" autocomplete="off"></label>
                                        @endif
                                        @if($user->background_color == 2)
                                        <label class="btn active border-0" style="background-color: #273C5B"><input type="radio" name="cor" value="2" autocomplete="off"></label>
                                        @else
                                        <label class="btn border-0" style="background-color: #273C5B"><input type="radio" name="cor" value="2" autocomplete="off"></label>
                                        @endif
                                        @if($user->background_color == 3)
                                        <label class="btn active border-0" style="background-color: #174042"><input type="radio" name="cor" value="3" autocomplete="off"></label>
                                        @else
                                        <label class="btn border-0" style="background-color: #174042"><input type="radio" name="cor" value="3" autocomplete="off"></label>
                                        @endif
                                        @if($user->background_color == 4)
                                        <label class="btn active border-0" style="background-color: #383844"><input type="radio" name="cor" value="4" autocomplete="off"></label>
                                        @else
                                        <label class="btn border-0" style="background-color: #383844"><input type="radio" name="cor" value="4" autocomplete="off"></label>
                                        @endif
                                        @if($user->background_color == 5)
                                        <label class="btn active border-0" style="background-color: #49423F"><input type="radio" name="cor" value="5" autocomplete="off"></label>
                                        @else
                                        <label class="btn border-0" style="background-color: #49423F"><input type="radio" name="cor" value="5" autocomplete="off"></label>
                                        @endif
                                        <br>
                                        @if($user->background_color == 6)
                                        <label class="btn active border-0" style="background-color: #5e3d22"><input type="radio" name="cor" value="6" autocomplete="off"></label>
                                        @else
                                        <label class="btn border-0" style="background-color: #5e3d22"><input type="radio" name="cor" value="6" autocomplete="off"></label>
                                        @endif
                                        @if($user->background_color == 7)
                                        <label class="btn active border-0" style="background-color: #234d6d"><input type="radio" name="cor" value="7" autocomplete="off"></label>
                                        @else
                                        <label class="btn border-0" style="background-color: #234d6d"><input type="radio" name="cor" value="7" autocomplete="off"></label>
                                        @endif
                                        @if($user->background_color == 8)
                                        <label class="btn active border-0" style="background-color: #3b5e5e"><input type="radio" name="cor" value="8" autocomplete="off"></label>
                                        @else
                                        <label class="btn border-0" style="background-color: #3b5e5e"><input type="radio" name="cor" value="8" autocomplete="off"></label>
                                        @endif
                                        @if($user->background_color == 9)
                                        <label class="btn active border-0" style="background-color: #0a4c3e"><input type="radio" name="cor" value="9" autocomplete="off"></label>
                                        @else
                                        <label class="btn border-0" style="background-color: #0a4c3e"><input type="radio" name="cor" value="9" autocomplete="off"></label>
                                        @endif
                                        @if($user->background_color == 10)
                                        <label class="btn active border-0" style="background-color: #7b3d54"><input type="radio" name="cor" value="10" autocomplete="off"></label>
                                        @else
                                        <label class="btn border-0" style="background-color: #7b3d54"><input type="radio" name="cor" value="10" autocomplete="off"></label>
                                        @endif
                                        <br>
                                    </div>
                                <button type="submit" class="btn btn-light btn--icon" data-toggle="tooltip" data-placement="top" title="Guardar a cor de fundo"><i class="zmdi zmdi-check"></i></button>
                            </form>
                            </div>
                            
                        </div>
                    </li>
                </ul>

                <div class="clock hidden-sm-down">
                    <div class="time ">
                        <span class="hours"></span>
                        <span class="min"></span>
                        <span class="sec"></span>
                    </div>
                </div>
            </header>

            <aside class="sidebar">
                <div class="scrollbar-inner">

                    <div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            @if(isset($imagem_fun) == 1 && str_contains($user->name, "admin"))
                            <img class="user__img" src="/img/escolas/{{$imagem_fun}}" alt="{{$imagem_fun}}">
                            @elseif(isset($imagem_fun) == 1)
                            <img class="user__img" src="/img/funcionarios/{{$imagem_fun}}" alt="{{$imagem_fun}}">
                            @elseif(isset($imagem_aluno) == 1)
                            <img class="user__img" src="/img/alunos/{{$imagem_aluno}}" alt="{{$imagem_aluno}}">
                            @elseif(isset($funcionario->imagem_fun) == 1)
                            <img class="user__img" src="/img/funcionarios/{{$funcionario->imagem_fun}}" alt="{{$funcionario->imagem_fun}}">
                            @endif
                            <div>
                                @yield('nome_aluno')
                                <div class="user__email">{{$user->permissao}}</div>
                                @if(strcasecmp($user->nome_escola, "NULL") > 0)
                                <div class="user__email">{{$user->nome_escola}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            @yield('settings')
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="/logout" class="dropdown-item"  onclick="event.preventDefault();
                                this.closest('form').submit();">Sair
                            </a>
                            </form>
                        </div>
                    </div>

                    <ul class="navigation">
                        
                        @yield('navbar')
                           @if(strcasecmp($user->permissao, "sige") > 0)
                            <li class="@@widgetactive"><img src="/img/escolas/{{$logo_escola->logo_escola}}" alt="Logo da escola"  width="100px" style="margin: auto; display:block;"></li>
                        @endif
                        
                           
                    </ul>
                </div>
            </aside>

            <section class="content">

                @yield('content')
                


                <footer class="footer">
                    <p>© SIGE. All rights reserved.</p>

                 
                </footer>
            </section>
        </main>

        <!-- Older IE warning message -->
            <!--[if IE]>
                <div class="ie-warning">
                    <h1>Warning!!</h1>
                    <p>You are using an outdated version of Internet Explorer, please upgrade to any of the following web browsers to access this website.</p>

                    <div class="ie-warning__downloads">
                        <a href="http://www.google.com/chrome">
                            <img src="img/browsers/chrome.png" alt="">
                        </a>

                        <a href="https://www.mozilla.org/en-US/firefox/new">
                            <img src="img/browsers/firefox.png" alt="">
                        </a>

                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                        </a>

                        <a href="https://support.apple.com/downloads/safari">
                            <img src="img/browsers/safari.png" alt="">
                        </a>

                        <a href="https://www.microsoft.com/en-us/windows/microsoft-edge">
                            <img src="img/browsers/edge.png" alt="">
                        </a>

                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                        </a>
                    </div>
                    <p>Sorry for the inconvenience!</p>
                </div>
            <![endif]-->

        <!-- Javascript -->
        <!-- Vendors -->
        <script src="/template/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="/template/vendors/bower_components/popper.js/dist/umd/popper.min.js"></script>
        <script src="/template/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/template/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/template/vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>

        <script src="/template/vendors/bower_components/salvattore/dist/salvattore.min.js"></script>
        <script src="/template/vendors/bower_components/flot/jquery.flot.js"></script>
        <script src="/template/vendors/bower_components/flot/jquery.flot.resize.js"></script>
        <script src="/template/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
        <script src="/template/vendors/bower_components/jqvmap/dist/jquery.vmap.min.js"></script>
        <script src="/template/vendors/bower_components/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="/template/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
        <script src="/template/vendors/bower_components/peity/jquery.peity.min.js"></script>
        <script src="/template/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="/template/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="/template/vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
        <!-- Charts and maps-->
        <script src="/template/demo/js/flot-charts/curved-line.js"></script>
        <script src="/template/demo/js/flot-charts/line.js"></script>
        <script src="/template/demo/js/flot-charts/dynamic.js"></script>
        <script src="/template/demo/js/flot-charts/chart-tooltips.js"></script>
        <script src="/template/demo/js/other-charts.js"></script>
        <script src="/template/demo/js/jqvmap.js"></script>

        <!-- App functions and actions -->
        <script src="/template/js/app.min.js"></script>
    </body>

<!--Designed By ALpha-->
</html>