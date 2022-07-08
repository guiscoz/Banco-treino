@extends('layouts.main')

@section('title', 'Gerenciando perfis')
    
@section('content')
<div class="container">
    <a class="text-success" href="{{ route('createPermission') }}">+ Cadastrar Permissão</a>

    <table class="table table-striped mt-4 mx-5">
        <thead>
            <th>ID</th>
            <th>Permissão</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>{{$permission->id}} </td>
                <td>{{$permission->name}} </td>
                <td class="d-flex">
                    <a class="mr-3 btn btn-sm btn-outline-success" href="/permission/edit/{{$permission->id}}">Editar</a>
                    <form action="/permission/delete/{{$permission->id}}" method="post">
                        @csrf
                        @method('delete')
                        <input class="btn btn-sm btn-outline-danger" type="submit" value="Remover">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection