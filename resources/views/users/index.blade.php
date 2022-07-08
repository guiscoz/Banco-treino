@extends('layouts.main')

@section('title', 'Gerenciando usuários')
    
@section('content')
<div class="container">
    <a class="text-success" href="{{ route('createUser') }}">+ Cadastrar Usuário</a>

    <table class="table table-striped mt-4 mx-5">
        <thead>
            <th>ID</th>
            <th>Usuário</th>
            <th>Email</th>
            <th>Data de cadastro</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
            <tr>
                @if($key > 0)
                    <td>{{$user->id-1}} </td>
                    <td>{{$user->name}} </td>
                    <td>{{$user->email}} </td>
                    <td>{{$user->created_at != null ? date_format($user->created_at, "d/m/Y") : 'Criado no Seeder' }} </td>
                    <td class="d-flex">
                        <a class="mr-3 btn btn-sm btn-outline-success" href="/user/edit/{{$user->id}}">Editar</a>
                        <a class="mr-3 btn btn-sm btn-outline-info" href="/user/{{$user->id}}/roles">Perfis</a>
                        <form action="/user/delete/{{$user->id}}" method="post">
                            @csrf
                            @method('delete')
                            <input class="btn btn-sm btn-outline-danger" type="submit" value="Remover">
                        </form>
                    </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection