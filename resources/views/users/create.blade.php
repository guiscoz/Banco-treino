@extends('layouts.main')

@section('title', 'Criar conta')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Novo usuário</div>

                <div class="card-body">

                    <a class="text-success" href="{{ route('users') }}"><- Voltar para a listagem</a>

                    @if($errors)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger mt-4" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form action="{{ route('storeUser') }}" method="post" class="mt-4" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nome do Usuário</label>
                            <input type="text" class="form-control" id="name" placeholder="Insira o nome completo do usuário"
                                   name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Insira um email válido"
                                   name="email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="name">Senha</label>
                            <input type="password" class="form-control" id="password" placeholder="Insira a senha"
                                   name="password" value="{{ old('password') }}">
                        </div>

                        <div class="form-group">
                            <label for="name">Confirme a senha</label>
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Insira a senha novamente"
                                   name="password_confirmation" value="{{ old('password') }}">
                        </div>

                        <button type="submit" class="btn btn-block btn-success">Cadastrar Novo Usuário</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection