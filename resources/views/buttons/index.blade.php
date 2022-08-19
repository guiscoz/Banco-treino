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
                                    <a href="" onclick="show_banks('{{ $user->id }}')" class="col-lg-2 col-sm-3 btn btn-large btn-default bg-primary">
                                        <p class="text-light">{{$user->name}}</p>
                                    </a>
                                @endforeach
                                {{-- <input type="text" name="seila" id="seila" value="seila"> --}}
                                <p id="seila">Sei la</p>
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
                        <div class="card-header">Contas</div>
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


<script>
    window.onload = function() {
        if (window.jQuery) {
            alert("jQuery working");
        } else {
            alert("jQuery Doesn't Work");
        }
    }

    var seila = $('#seila').text();
    alert(seila);

    function show_banks(userId) {
        $("#listAccounts").empty();
        $("#localizedAccounts").animate({opacity: "show"}, "normal").css("display", "none");
        axios.get('user_accounts/bank_list/'+userId, {})
            .then(response => {
                $("#listBanks").empty();
                popBanks = '';
                if (response.data == '') {
                    popBanks = 'Nenhum registro foi localizado.';
                } else {
                    $.each(response.data, function (key, item) {
                        popBanks += '<a href="#" onclick="find_accounts('+key+')" class="col-lg-2 col-sm-6 btn btn-large btn-default">';
                        popBanks += item;
                        popBanks += '</a>';
                    });
                }
                $("#listBanks").append(popBanks);
            })
        .catch(
            error => {
                console.log(error);
            }
        );
        $("#selectBank").animate({opacity: "show"}, "normal").css("display", "");
    }

    function find_accounts(userId) {
        axios.get('../bank_list/'+userId, {})
            .then(response => {
                $("#listAccounts").empty();
                popAccounts = '';
                if (response.data == '') {
                    $("#listAccounts").empty();
                    popAccounts = 'Nenhum registro foi localizado.';
                } else {
                    $.each(response.data, function (key, item) {
                        console.log(key);
                        popAccounts += '<a href="#" onclick="account_details('+key+')" class="col-lg-3 col-sm-6 btn btn-large btn-default">';
                        popAccounts += item;
                        popAccounts += '</a>';
                    });
                }
                $("#listAccounts").append(popAccounts);
            })
        .catch(
            error => {
                console.log(error);
            }
        );
        $("#localizedAccounts").animate({opacity: "show"}, "normal").css("display", "");
    }

    function account_details(bankId) {
        axios.get('../user_account/'+bankId, {})
            .then(response => {
                var innerHtml = '<table class="table table-striped table-hover table-sm">';
                innerHtml += '<tr>';
                innerHtml += '<td><strong>Número da conta</strong></td>';
                innerHtml += '<td><strong>Banco</strong></td>';
                innerHtml += '<td><strong>Saldo</strong></td>';
                innerHtml += '</tr>';
                $.each(response.data, function (key, item) {
                    innerHtml += '<tr>';
                    innerHtml += '<td>';
                    innerHtml += item['number']+'x';
                    innerHtml += '</td>';
                    innerHtml += '<td>';
                    innerHtml += item['namen']+'%';
                    innerHtml += '</td>';
                    innerHtml += '<td>';
                    innerHtml += item['fund'];
                    innerHtml += '</td>';
                    innerHtml += '</tr>';
                });
                innerHtml += '</table>';
                Swal.fire({
                    title: 'Contas',
                    html: innerHtml,
                    width: 800,
                    showCloseButton: true,
                    confirmButtonText: 'Fechar'
                });
            })
        .catch(
            error => {
                console.log(error);
            }
        );
    }
</script>