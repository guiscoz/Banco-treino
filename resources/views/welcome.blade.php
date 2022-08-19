@extends('layouts.main')

@section('title', 'Banco teste')

@section('content')

    <div class="container pb-5">
        @auth
            @component('components.header', [
                'username' => $user->name
            ])
            @endcomponent

            @foreach($accounts as $account)
                @if ($account->user_id == $user->id)
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">{{ $account->name }} - {{ $account->number }}</div>
                            <div class="card-date">Cadastrado neste site em: {{ $account->created_at != null ? $account->created_at->format('H:i - d/m/Y') : 'Criado no Seeder'}}</div>
                            <div class="card-date">Última atualização: {{ $account->updated_at != null ? $account->updated_at->format('H:i - d/m/Y') : 'criado no Seeder'}}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endauth
        @guest
            <div class="card mt-3">
                @component('components.header', [])
                @endcomponent
                <div class="card-body">
                    <div class="card-title">...</div>
                    <div class="card-date">Para ver suas contas neste site, é necessário fazer
                        <a href="login">login</a> ou <a href="register">cadastro</a>.
                    </div>
                </div>
            </div>
        @endguest

        <div class="card mt-5 p-3">
            <label for="cep">Digite um CEP: </label>
            <input type="number" name="cep" id="cep" pattern="\d{5}-\d{3}" oninput="GetCep(this.value)">
        </div>

        <div class="card mt-5 p-3">
            <div class="card-title" id='cep-title'>CEP: </div>
            <div class="card-date" id="uf">UF: </div>
            <div class="card-date" id="localidade">Localidade: </div>
            <div class="card-date" id="bairro">Bairro: </div>
            <div class="card-date" id="logradouro">Logradouro: </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function GetCep(cep) {
            cep = document.getElementById('cep').value;
            notFound = 'Não encontrado';

            if(cep.length != 8) {
                return;
            }

            axios.get("http://viacep.com.br/ws/"+cep+"/json/", {})
            .then(response => {
                console.log(response.data);

                if(response.data.erro) {
                    document.getElementById('cep-title').innerText = `CEP: ${notFound}`;
                    document.getElementById('logradouro').innerText = `Logradouro: ${notFound}`;
                    document.getElementById('uf').innerText = `UF: ${notFound}`
                    document.getElementById('bairro').innerText = `Bairro: ${notFound}`
                    document.getElementById('localidade').innerText = `Localidade: ${notFound}`;
                    return;
                }

                document.getElementById('cep-title').innerText = `CEP: ${response.data.cep ? response.data.cep : 'Não definido'}`;
                document.getElementById('logradouro').innerText = `Logradouro: ${response.data.logradouro ? response.data.logradouro : 'Não definido'}`;
                document.getElementById('uf').innerText = `UF: ${response.data.uf ? response.data.uf : 'Não definido'}`;
                document.getElementById('bairro').innerText = `Bairro: ${response.data.bairro ? response.data.bairro : 'Não definido'}`;
                document.getElementById('localidade').innerText = `Localidade: ${response.data.localidade ? response.data.localidade : 'Não definido'}`;
            }).catch(
                erro => {
                    console.log(erro);
                }
            );
      }
    </script>

@endsection