@extends('layouts.main')

@section('title', 'Perfis do usuário')
    
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perfis de {{ $user->name }}</div>

                <div class="card-body">

                    <a class="text-success" href="{{ route('users') }}">&leftarrow; Voltar para a listagem</a>

                    @if($errors)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger mt-4" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form action="/user/{{ $user->id }}/roles/sync" method="post" class="mt-4" autocomplete="off">
                        @csrf
                        @method('PUT')

                        @foreach($roles as $key => $role)
                            @if($key > 0)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="{{ $role->id }}" name="{{ $role->id }}" {{ ($role->can == '1' ? 'checked' : '') }}>
                                    <label class="custom-control-label" for="{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            @endif
                        @endforeach

                        <button type="submit" class="btn btn-block btn-success mt-4">Sincronizar Usuário</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection