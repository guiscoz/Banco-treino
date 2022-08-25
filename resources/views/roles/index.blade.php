@extends('layouts.main')

@section('title', 'Gerenciando perfis')

@section('content')
<div class="container">
    <a class="text-success" href="{{ route('createRole') }}">+ Cadastrar Perfil</a>

    <table class="table table-striped mt-4 mx-5">
        <thead>
            <th>ID</th>
            <th>Perfil</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($roles as $key => $role)
            <tr>
                @if($key > 0)
                    <td>{{$role->id-1}} </td>
                    <td>{{$role->name}} </td>
                    <td class="d-flex">
                        <a class="mr-3 btn btn-sm btn-outline-success" href="/role/edit/{{$role->id}}">Editar</a>
                        <a class="mr-3 btn btn-sm btn-outline-info" href="/role/{{$role->id}}/permissions">Permissões</a>
                        <form action="/role/delete/{{$role->id}}" method="post">
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