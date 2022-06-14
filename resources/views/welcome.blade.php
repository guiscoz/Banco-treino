@extends('layouts.main')

@section('title', 'Banco teste')
    
@section('content')

    <div class="accounts-container">
        @auth
            <h1>Bem-vindo {{ $user->name }}, sinta-se a vontade para mexer nas suas contas.</h1>
            @foreach($accounts as $account)
                @if ($account->user_id == $user->id)
                    <div class="card">  
                        <div class="card-body">
                            <div class="card-title">{{ $account->name }} - {{ $account->number }}</div>
                            <div class="card-date">Cadastrado neste site em: {{ $account->created_at->format('H:i - d/m/Y') }}</div>
                            <div class="card-date">Última atualização: {{ $account->updated_at->format('H:i - d/m/Y') }}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endauth
        @guest
            <div class="card">
                <h1>Bem-vindo ao nosso site</h1>
                <div class="card-body">
                    <div class="card-title">...</div>
                    <div class="card-date">Para ver suas contas neste site, é necessário fazer 
                        <a href="login">login</a> ou <a href="register">cadastro</a>.
                    </div>
                </div>
            </div>
        @endguest
    </div>

@endsection