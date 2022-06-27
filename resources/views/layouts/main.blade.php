<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>@yield('title')</title>

    </head>

    <body class="antialiased p-3">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand">
                        <img src="{{asset('storage/bancoLogo.png')}}" alt="Banco Treino" style="height: 40px;">
                    </a>
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link">Minhas contas</a>
                            </li>
                            <li class="nav-item">
                                <a href="/accounts/create" class="nav-link">Cadastrar contas</a>
                            </li>
                            <li class="nav-item">
                                <a href="/accounts/file" class="nav-link">Arquivos</a>
                            </li>
                            <li class="nav-item">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <a href="/logout" 
                                        class="nav-link"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                >
                                    Sair
                                </a>
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a href="/login" class="nav-link">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register" class="nav-link">Cadastrar</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>
        
        <main>
            <div class="container-fluid">
                <div class="row">
                    @if(session('msg'))
                        <p class="msg">{{ session('msg') }}</p>
                    @endif
                    @yield('content')   
                </div>
            </div>
        </main>

        <footer>
            <p>Banco Treino</p>
        </footer>

        
        <script src="{{asset('js/ionicons.esm.js')}}"></script>
        <script src="{{asset('js/ionicons.js')}}"></script>
        
    </body>
</html>