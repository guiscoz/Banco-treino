@extends('layouts.main')

@section('title', 'Perfil')
    
@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Minhas contas</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($accounts) > 0)
        <table class="table">
            <head>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Numero do banco</th>
                    <th scope="col">Saldo atual</th>
                </tr>
            </head>
        
            <tbody>
                @foreach($accounts as $account)
                    <tr>
                        <td scope="row">{{$loop->index+1}}</td>
                        <td>{{ $account->name }}</a></td>
                        <td>{{ $account->number }}</td>
                        <td>R$ {{ number_format($account->fund, 2) }}</td>
                        <td>
                            <a href="/accounts/edit/{{ $account->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a> 
                            <form action="/accounts/{{ $account->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn">
                                    <ion-icon name="trash-outline"></ion-icon> Deletar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Você ainda não tem uma conta cadastrada, <a href="/accounts/create"> cadastre uma</a>.</p>
        @endif
</div>
@endsection