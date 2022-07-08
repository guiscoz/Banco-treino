@extends('layouts.main')

@section('title', 'Banco teste')
    
@section('content')

    <div class="container pb-5">
        @auth
            {{-- <x-header username="{{ $user->name }}" /> --}}
            @component('components.header', [
                'username' => $user->name
            ])
            @endcomponent

            @foreach($accounts as $account)
                @if ($account->user_id == $user->id)
                    <div class="card">  
                        <div class="card-body">
                            <div class="card-title">{{ $account->name }} - {{ $account->number }}</div>
                            <div class="card-date">Cadastrado neste site em: {{ $account->created_at != null ? $account->created_at->format('H:i - d/m/Y') : 'criado no Seeder'}}</div>
                            <div class="card-date">Última atualização: {{ $account->updated_at != null ? $account->updated_at->format('H:i - d/m/Y') : 'criado no Seeder'}}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endauth
        @guest
            <div class="card">
                {{-- <x-header /> --}}
                @component('components.header', [])
                @endcomponent
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