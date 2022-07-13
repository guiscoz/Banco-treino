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
        $account = new Account;

        $account->name = $request->bankName;
        $account->number = $request->bankNumber;
        $account->fund = $request->bankFund;
        
        $user = auth()->user(); 
        $account->user_id = $user->id; 

        $repeated = Account::where([['name', '=', $account->name]])->first();

        if($repeated == null) {
            $account->save(); 
            return redirect()->route('index')->with('msg', 'Conta criada com sucesso!');  
        } else {
            return redirect()->route('createAccount')->with('alert', 'Não é possível ter mais de uma conta no mesmo banco.');
        } 
    }

    public function edit($id) {
        $user = auth()->user();
        $account = Account::findOrFail($id);

        if($user->id != $account->user_id) {
            return redirect('/dashboard');
        }

        return view('accounts.edit', ['account' => $account]);
    }

    public function update(FundRequest $request, $id) {
        //$data = $request->all();

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
            return redirect()->route('editAccount', [$id])->with('alert', 'Não foi possível retirar essa quantidade de dinheiro da sua conta.');
        }   
    }

    public function destroy($id) {
        Account::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg', 'Conta excluída com sucesso!');
    }
}