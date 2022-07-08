@extends('layouts.main')

@section('title', 'Editando o usuário ' . $user->name)
    
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editando o usuário {{ $user->name }}</div>

                    <div class="card-body">

                        <a class="text-success" href="{{ route('users') }}"><- Voltar para a listagem</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form action="/user/update/{{$user->id}}" method="post" class="mt-4" autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nome do Usuário</label>
                                <input type="text" class="form-control" id="name" placeholder="Insira o nome completo do usuário"
                                    name="name" value="{{ old('name') ?? $user->name }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Insira um email válido"
                                    name="email" value="{{ old('email') ?? $user->email }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Senha</label>
                                <input type="password" class="form-control" id="password" placeholder="Insira a senha"
                                    name="password" value="{{ old('password') }}">
                            </div>

                            <button type="submit" class="btn btn-block btn-success">Editar Usuário</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection