@extends('layouts.main')

@section('title', 'Criar conta')
    
@section('content')

    <div class="container">
        <h1>Abrindo uma nova conta</h1>
        <form action="/accounts/store" method="POST" class="py-4">
            @csrf
            <div class="pb-4">
                <label for="name">Qual é o nome do banco?</label>
                <input type="text" name="name">   
            </div>
            <div class="pb-4">
                <label for="number" p>Qual é o número do banco?</label>
                <input type="number" name="number">
            </div>
            <div class="pb-4">
                <label for="fund">Quantos reais você tem nesta conta?</label>
                <input type="number" name="fund" step="any">
            </div>
            <div>
                <input type="submit" value="Cadastrar conta" class="btn btn-info edit-btn">
            </div>
        </form>
    </div>

@endsection