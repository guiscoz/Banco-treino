@extends('layouts.main')

@section('title', 'Gerenciando usuários')
    
@section('content')
<div class="container">
    <a class="text-success" href="{{ route('createUser') }}">+ Cadastrar Usuário</a>

    @if($errors)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger mt-4" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{route('users')}}" method="post" class="mt-5">
        @csrf
        <label for="usersPerPage">Exibir quanto usuários por página: </label>
        <input type="number" min="1" max="1000" value="{{$numberUsers}}" step="1" name="usersPerPage" id="usersPerPage">
        <input type="submit" value="Atualizar">
    </form>

    <table class="table table-striped mt-4 mx-5">
        <thead>
            <th>ID</th>
            <th>Usuário</th>
            <th>Email</th>
            <th>Data de cadastro</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}} </td>
                <td>{{$user->name}} </td>
                <td>{{$user->email}} </td>
                <td>{{$user->created_at != null ? date_format($user->created_at, "s:i:H - d/m/Y") : 'Criado no Seeder' }} </td>
                <td class="d-flex">
                    <a class="mr-3 btn btn-sm btn-outline-success" href="/user/edit/{{$user->id}}">Editar</a>
                    <a class="mr-3 btn btn-sm btn-outline-info" href="/user/{{$user->id}}/roles">Perfis</a>
                    <form action="/user/delete/{{$user->id}}" method="post">
                        @csrf
                        @method('delete')
                        <input class="btn btn-sm btn-outline-danger" type="submit" value="Remover">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{$users->links()}}

    <table class="table table-striped mt-4 mx-5">
        <thead>
            <th>ID</th>
            <th>Usuário</th>
            <th>Email</th>
        </thead>
        <tbody>
            @foreach($specificUsers as $specificUser)
            <tr>
                <td>{{$specificUser->id}} </td>
                <td>{{$specificUser->name}} </td>
                <td>{{$specificUser->email}} </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{$specificUsers->links()}}

</div>
@endsection