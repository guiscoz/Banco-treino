@extends('layouts.main')

@section('title', 'Criar conta')
    
@section('content')

    <div class="bank-container">
        <h1>Abrindo uma nova conta</h1>
        <form action="/accounts" method="POST">
            @csrf
            <label for="name">Qual é o nome do banco?</label>
            <input type="text" name="name">
            <br>
            <label for="number">Qual é o número do banco?</label>
            <input type="number" name="number">
            <br>
            <label for="fund">Quantos reais você tem nesta conta?</label>
            <input type="number" name="fund" step="any">
            <br>
            <input type="submit" value="Cadastrar conta">
        </form>
    </div>

@endsection