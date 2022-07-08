@extends('layouts.main')

@section('title', 'Editando a permissão: ' . $permission->name)
    
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editando a permissão {{ $permission->name }}</div>

                    <div class="card-body">

                        <a class="text-success" href="{{ route('permissions') }}"><- Voltar para a listagem</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form action="/permission/update/{{$permission->id}}" method="post" class="mt-4" autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nome da Permissão</label>
                                <input type="text" class="form-control" id="name" placeholder="Insira o nome da permissão"
                                    name="name" value="{{ old('name') ?? $permission->name }}">
                            </div>

                            <button type="submit" class="btn btn-block btn-success">Editar Permissão</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection