@extends('layouts.main')

@section('title', 'Contas de usuários')

@section('content')

    <section class="content col-12 mt-5">
        <div class="card p-3 mb-5">
            <div class="card-title"><h1>Localização do usuário</h1></div>
            @if(!empty($location))
                @if($location->status == "success")
                    <div class="row mx-1">
                        <p>Para atualizar sua localização, <a class="text-success" href="{{ route('locations.update', $user->id) }}">clique aqui.</a></p>
                    </div>
                    <div class="row mt-4">
                        <div class="col-3" id="lat">
                            <p>IP: {{ $location->query }}</p>
                        </div>
                        <div class="col-3" id="lat">
                            <p>Latitude: {{ $location->lat }}</p>
                        </div>
                        <div class="col-3" id="lon">
                            <p>Longitude: {{ $location->lon }}</p>
                        </div>
                        <div class="col-3" id="lon">
                            <p>Fuso horário: {{ $location->timezone }}</p>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-3" id="lat">
                            <p>País: {{ $location->country }}</p>
                        </div>
                        <div class="col-3" id="lat">
                            <p>Estado: {{ $location->regionName }}</p>
                        </div>
                        <div class="col-3" id="lon">
                            <p>Cidade: {{ $location->city }}</p>
                        </div>
                        <div class="col-3" id="lon">
                            <p>CEP: {{ $location->zip }}</p>
                        </div>
                    </div>
                @else
                    <div class="row mx-1">
                        <p>Tem algo de errado com seu IP. <a class="text-success" href="{{ route('locations.update', $user->id) }}">Clique aqui</a> caso queira atualizar.</p>
                    </div>
                @endif
            @else
                <div class="row mx-1">
                    <p>Você ainda não gravou sua localização. <a class="text-success" href="{{ route('locations.store') }}">Clique aqui</a> para gravar.</p>
                </div>
            @endif
        </div>
    </section>

@endsection
