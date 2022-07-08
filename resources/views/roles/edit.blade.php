@extends('layouts.main')

@section('title', 'Editando o perfil: ' . $role->name)
    
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editando o perfil {{ $role->name }}</div>

                    <div class="card-body">

                        <a class="text-success" href="{{ route('roles') }}"><- Voltar para a listagem</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form action="/role/update/{{$role->id}}" method="post" class="mt-4" autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nome do Perfil</label>
                                <input type="text" class="form-control" id="name" placeholder="Insira o nome complete perfil"
                                    name="name" value="{{ old('name') ?? $role->name }}">
                            </div>

                            <button type="submit" class="btn btn-block btn-success">Editar Perfil</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection