@extends('layouts.main')

@section('title', 'Perfil')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Minhas contas</h1>
</div>


<div class="col-md-10 offset-md-1">
    @if(count($accounts) > 0)
        @component('components.dashboardComponent', [
            'accounts' => $accounts,
            'contents' => ['#', 'Nome', 'Número do banco', 'Saldo bancário', 'Opções'],
        ])
        @endcomponent
   @else
        <p>Você ainda não tem uma conta cadastrada, <a href="/accounts/create"> cadastre uma</a>.</p>
    @endif
</div>

@endsection