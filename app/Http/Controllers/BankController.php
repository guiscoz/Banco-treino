<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;
use App\Models\User;

class BankController extends Controller
{
    public function index(){

        $accounts = Account::all();
        $user = auth()->user(); 

        return view('welcome', ['accounts' => $accounts, 'user' => $user]);
    }

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

        $account->save(); 
        return redirect('/')->with('msg', 'Conta criada com sucesso!');
    }

    public function dashboard() {
        $user = auth()->user();
        $accounts = $user->accounts;

        return view ('dashboard', ['accounts' => $accounts]);
    }

    public function edit($id) {
        $user = auth()->user();
        $account = Account::findOrFail($id);

        if($user->id != $account->user_id) {
            return redirect('/dashboard');
        }

        return view('accounts.edit', ['account' => $account]);
    }

    public function destroy($id) {
        Account::findOrFail($id)->delete(); //só isso basta para apagar o registro do banco
        return redirect('/dashboard')->with('msg', 'Conta excluída com sucesso!');
    }

    public function dump($data){
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        die;
    }

    public function update(Request $request, $id) {
        //dd($request->all());
        $data = $request->all();
        // echo "<pre>";
        // var_dump($data);
        // echo "</pre>";
        // die;

        $currentFund= Account::findOrFail($id);

        $dataAmmount = filter_input(INPUT_POST, "ammount", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $dataTransaction = filter_input(INPUT_POST, "transaction", FILTER_SANITIZE_NUMBER_INT);
        if($dataTransaction  == 2) {
            $newFund = $currentFund->fund - $dataAmmount;
        } else {
            $newFund = $currentFund->fund + $dataAmmount;
        }

        $currentFund->fund = $newFund;

        $newData = [
            'fund' => $newFund,
        ];

        Account::findOrFail($request->id)->update($newData);
        return redirect('/dashboard')->with('msg', 'Saldo alterado com sucesso!');
    }
}
