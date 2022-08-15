@extends('layouts.main')

@section('title', 'Perfil')

@section('content')

    <div class="container">
        <h1 class="mb-4">Página de upload</h1>
        <form action="/accounts/upload" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label for="txt" class="col">Escolha um arquivo .txt com seus dados para fazer upload.</label>
                <input type="file" name="txt" class="col">
            </div>
            <div class="row mb-3">
                <label for="image" class="col">Escolha um arquivo .png para servir como uma foto sua.</label>
                <input type="file" name="image" class="col">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-upload"></i> Fazer upload
            </button>
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

        @if (file_exists(public_path('userFiles/userTxt'.$user->id.'.txt')))
            <div class="row mt-5">
                <div class="col">
                    <form action="{{route('download','userTxt'.$user->id.'.txt')}}" method="GET" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa-solid fa-download"></i> Baixar texto atual
                        </button>
                    </form>
                </div>
                <div class="col">
                    <form action="{{route('delete','userTxt'.$user->id.'.txt')}}" method="GET" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-danger delete-btn">
                            <i class="fa-solid fa-trash"></i> Deletar texto atual
                        </button>
                    </form>
                </div>
            </div>
        @endif

        @if (file_exists(public_path('userFiles/userImage'.$user->id.'.png')))
            <div class="row my-5">
                <div class="col">
                    <form action="{{route('download','userImage'.$user->id.'.png')}}" method="GET" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa-solid fa-download"></i> Baixar imagem atual
                        </button>
                    </form>
                </div>
                <div class="col">
                    <form action="{{route('delete','userImage'.$user->id.'.png')}}" method="GET" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-danger delete-btn">
                            <i class="fa-solid fa-trash"></i> Deletar imagem atual
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div> 

@endsection