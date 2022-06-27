@extends('layouts.main')

@section('title', 'Perfil')
    
@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Minhas contas</h1>
</div>

<!--
Início do bloco para transformar em componente.
Você deverá criar um componente que carregue da forma mais simples possível,
passaando somente os parâmetros, mas carregando na tela exatamente da forma
que está hoje.
-->
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($accounts) > 0)
        <table class="table">
            <head>
                @component('components.tables.tableHead', [
                    'contents' => ['#', 'Nome', 'Número do banco', 'Saldo bancário', 'Opções']
                ])
                @endcomponent
            </head>
        
            <tbody>
                @foreach($accounts as $account)
                    @component('components.tables.tableData', [
                        'index' => $loop->index+1,
                        'data' => [$account->name, $account->number, number_format($account->fund, 2)],
                        'id' => $account->id
                    ])
                    @endcomponent
                @endforeach
            </tbody>
        </table>
    @else
        <p>Você ainda não tem uma conta cadastrada, <a href="/accounts/create"> cadastre uma</a>.</p>
    @endif
</div>
<!-- Fim do bloco para componetizar -->

@endsection