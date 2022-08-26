<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Account;
use App\Models\User;
use App\Http\Requests\BankRequest;
use App\Http\Requests\FundRequest;

class BankController extends Controller
{
    public function create() {
        return view('accounts.create');
    }

    public function store(BankRequest $request) {
        $user = auth()->user();

        $newAccount = [
            'name' => $request->bankName,
            'number' => $request->bankNumber,
            'fund' => $request->bankFund,
            'user_id' => $user->id
        ];

        $repeated = Account::where([['name', '=', $request->bankName], ['user_id', '=', $user->id]])->first();

        if(empty($repeated)) {
            if (Account::create($newAccount)) {
                $request->session()->flash('msg', 'Gravação feita com sucesso!');
            }
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('createAccount')
                ->with('alert', 'Não é possível ter mais de uma conta no mesmo banco.');
        }
    }

    public function edit($id) {
        $user = auth()->user();
        $account = Account::findOrFail($id);

        if($user->id != $account->user_id) {
            return redirect('/dashboard');
        }

        return view('accounts.edit', compact('account'));
    }

    public function update(FundRequest $request, $id) {
        $currentFund= Account::findOrFail($id);

        $dataAmmount = filter_input(INPUT_POST, "ammount", FILTER_VALIDATE_FLOAT);
        $dataTransaction = filter_input(INPUT_POST, "transaction", FILTER_VALIDATE_INT);
        if($dataTransaction  == 2) {
            $newFund = $currentFund->fund - $dataAmmount;
        } else {
            $newFund = $currentFund->fund + $dataAmmount;
        }

        if($newFund >= 0){
           $currentFund->fund = $newFund;

            $newData = [
                'fund' => $newFund,
            ];

            Account::findOrFail($request->id)->update($newData);
            return redirect('/dashboard')->with('msg', 'Saldo alterado com sucesso!');
        } else {
            return redirect()->route('editAccount', [$id])
                ->with('alert', 'Não foi possível retirar essa quantidade de dinheiro da sua conta.');
        }
    }

    public function destroy($id) {
        Account::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg', 'Conta excluída com sucesso!');
    }
}