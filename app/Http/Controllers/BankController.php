<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Account;
use App\Models\User;

class BankController extends Controller
{
    public function create() {
        return view('accounts.create');
    }

    public function store(Request $request) {
        $account = new Account;

        $account->name = $request->name;
        $account->number = $request->number;
        $account->fund = $request->fund;
        
        $user = auth()->user(); 
        $account->user_id = $user->id; 

        $repeated = Account::where([['name', '=', $account->name]])->first();

        if($repeated == null) {
            $account->save(); 
            return redirect()->route('index')->with('msg', 'Conta criada com sucesso!');  
        } else {
            return redirect()->route('createAccount')->with('msg', 'Não é possível ter mais de uma conta no mesmo banco.');
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

    public function update(Request $request, $id) {
        $data = $request->all();

        $currentFund= Account::findOrFail($id);

        $dataAmmount = filter_input(INPUT_POST, "ammount", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $dataTransaction = filter_input(INPUT_POST, "transaction", FILTER_SANITIZE_NUMBER_INT);
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
            return redirect()->route('editAccount', [$id])->with('msg', 'Não foi possível retirar essa quantidade de dinheiro da sua conta.');
        }   
    }

    public function destroy($id) {
        Account::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg', 'Conta excluída com sucesso!');
    }
}