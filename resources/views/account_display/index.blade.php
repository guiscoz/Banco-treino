@extends('layouts.main')

@section('title', 'Contas de usuários')

@section('content')

    <section class="content col-12 mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-5">
                        <div class="card-header">Usuários</div>
                        <div class="card-body p-2">

                            <div class="col-lg-12 col-sm-12 text-center">
                                @foreach ($users as $key => $user)
                                    <button onclick="show_banks('{{ $user->id }}')" class="col-lg-2 col-sm-3 btn btn-large btn-default bg-primary">
                                        <p class="text-light">{{$user->name}}</p>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div id="selectBank" class="card mb-5" style="display:none">
                        <div class="card-header">Bancos</div>
                        <div class="card-body p-2">
                            <div id="listBanks" class="col-lg-12 col-sm-12 text-center">
                            </div>
                        </div>
                    </div>

                    <div id="localizedAccounts" class="card mb-5" style="display:none">
                        <div class="card-header">Conta</div>
                        <div class="card-body p-2">
                            <div id="listAccounts" class="col-lg-12 col-sm-12 text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


<script type="text/javascript">
    function show_banks(userId) {
        var listAccounts = document.getElementById('listAccounts');
        while(listAccounts.firstChild) {
            listAccounts.removeChild(listAccounts.firstChild);
        }

        var localizedAccounts = document.getElementById('localizedAccounts');
        localizedAccounts.style.display = "none";

        axios.get('user_accounts/bank_list/'+userId, {})
            .then(response => {
                var listBanks = document.getElementById('listBanks');
                while(listBanks.firstChild) {
                    listBanks.removeChild(listBanks.firstChild);
                }

                popBanks = '';
                if (response.data == '') {
                    popBanks = '<p>Nenhum registro foi localizado.</p>';
                } else {
                    response.data.forEach(function(item){
                        popBanks += '<button onclick="find_accounts('+item.id+')" class="col-lg-2 col-sm-3 btn btn-large btn-default bg-primary mr-2 text-light">';
                        popBanks += item.name;
                        popBanks += '</button>';
                    });
                }
                listBanks.insertAdjacentHTML('beforeend', popBanks);
            })
        .catch(
            error => {
                console.log(error);
            }
        );

        var selectBank = document.getElementById('selectBank');
        selectBank.style.display = "";
    }

    function find_accounts(bankId) {
        axios.get('user_accounts/bank_list/bank/'+bankId, {})
            .then(response => {
                var listAccounts = document.getElementById('listAccounts');
                while(listAccounts.firstChild) {
                    listAccounts.removeChild(listAccounts.firstChild);
                }

                popAccounts = '';
                if (response.data == '') {
                    popAccounts = '<p>Nenhum registro foi localizado.</p>';
                } else {
                    accountFund = response.data.fund.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

                    popAccounts = '<table class="table table-striped table-hover table-sm">';
                    popAccounts += '<tr>';
                    popAccounts += '<td><strong>Número da conta</strong></td>';
                    popAccounts += '<td><strong>Banco</strong></td>';
                    popAccounts += '<td><strong>Saldo</strong></td>';
                    popAccounts += '<td><strong>Apagar</strong></td>';
                    popAccounts += '</tr>';
                    popAccounts += '<tr>';
                    popAccounts += '<td>'+response.data.number+'</td>';
                    popAccounts += '<td>'+response.data.name+'</td>';
                    popAccounts += '<td>'+accountFund+'</td>';
                    popAccounts += '<td><form action=/accounts/'+response.data.id+' method="post">@csrf @method("DELETE")';
                    popAccounts += '<button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                    popAccounts += '</td></form>';
                    popAccounts += '</tr>';
                    popAccounts += '</table>';
                }
                listAccounts.insertAdjacentHTML('beforeend', popAccounts);
            })
        .catch(
            error => {
                console.log(error);
            }
        );

        var localizedAccounts = document.getElementById('localizedAccounts');
        localizedAccounts.style.display = "";
    }

</script>