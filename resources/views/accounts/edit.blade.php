@extends('layouts.main')

@section('title', 'Movimentar dinheiro do ' . $account->name)
    
@section('content')
    <div class="container">
        <h1>O seu saldo atual do {{ $account->name }} é de R${{ number_format($account->fund, 2) }}</h1>
        <form action="/accounts/update/{{ $account->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="ammount">Qual é o novo valor do saldo?</label>
            <input type="number" name="ammount" step="any" min="0" >
            <select name="transaction">
                <option value="1">Depositar</option>
                <option value="2">Retirar</option>
            </select>
            <input type="submit" value="Confirmar">
        </form>

        @if($errors)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger mt-4" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
    </div>

@endsection