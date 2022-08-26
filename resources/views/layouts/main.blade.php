<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <title>@yield('title')</title>

    </head>

    <body class="antialiased p-3">
        <header class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="{{ route('index') }}" class="navbar-brand">
                        <img src="{{asset('bancoLogo.png')}}" alt="Banco Treino" style="height: 40px;">
                    </a>
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">Minhas contas</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('file')}}" class="nav-link">Arquivos</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('locations.index') }}" class="nav-link">Minha localização</a>
                            </li>
                            @can('Gerenciar usuários')
                                <li class="nav-item">
                                    <a href="{{route('users')}}" class="nav-link">Gerenciar usuários</a>
                                </li>
                            @endcan
                            @can('Gerenciar usuários')
                                <li class="nav-item">
                                    <a href="{{route('user_accounts.index')}}" class="nav-link">Contas de usuários</a>
                                </li>
                            @endcan
                            @can('Gerenciar perfis')
                                <li class="nav-item">
                                    <a href="{{route('roles')}}" class="nav-link">Gerenciar perfis</a>
                                </li>
                            @endcan
                            @can('Gerenciar permissões')
                            <li class="nav-item">
                                <a href="{{route('permissions')}}" class="nav-link">Gerenciar permissões</a>
                            </li>
                            @endcan
                            @can('Acessar o Google')
                                <a href="https://www.google.com.br/" class="nav-link">Acessar o Google</a>
                            @endcan
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
                    @if(session('alert'))
                        <p class="msg-alert">{{ session('alert') }}</p>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>

        <footer class="container-fluid">
            <p>Banco Treino</p>
        </footer>

        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('js/ionicons.esm.js')}}"></script>
        <script src="{{asset('js/ionicons.js')}}"></script>
    </body>
</html>