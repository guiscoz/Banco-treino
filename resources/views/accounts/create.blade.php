@extends('layouts.main')

@section('title', 'Criar conta')

@section('content')

    <div class="container">
        <h1>Abrindo uma nova conta</h1>
        <form action="/accounts/store" method="POST" class="py-4">
            @csrf
            <div class="pb-4">
                <label for="bankName">Qual é o nome do banco?</label>
                <input type="text" name="bankName">
            </div>
            <div class="pb-4">
                <label for="bankNumber" p>Qual é o número do banco?</label>
                <input type="number" name="bankNumber">
            </div>
            <div class="pb-4">
                <label for="bankFund">Quantos reais você tem nesta conta?</label>
                <input type="number" name="bankFund" step="any">
            </div>
            <div>
                <input type="submit" value="Cadastrar conta" class="btn btn-info edit-btn">
            </div>
        </form>

        @if($errors->any())
            <br>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

@endsection