<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

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

        $repeated = Account::where([['name', '=', $account->name]])->first();

        if($repeated == null) {
            $account->save(); 
            return redirect()->route('index')->with('msg', 'Conta criada com sucesso!');  
        } else {
            return redirect()->route('create')->with('msg', 'Não é possível ter mais de uma conta no mesmo banco.');
        } 
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

        if($newFund >= 0){
           $currentFund->fund = $newFund;

            $newData = [
                'fund' => $newFund,
            ];
            
            Account::findOrFail($request->id)->update($newData);
            return redirect('/dashboard')->with('msg', 'Saldo alterado com sucesso!');
        } else {
            return redirect()->route('edit', [$id])->with('msg', 'Não foi possível retirar essa quantidade de dinheiro da sua conta.');
        }   
    }

    public function file() {
        $user = auth()->user();
        return view('accounts.file', ['user' => $user]);
    }

    public function upload(Request $request) {
        $user = auth()->user();

        $validade = $request ->validate(
            //regras
            [
                'txt' => 'mimes:txt',
                'image' => 'image|mimes:png'
            ],
            //mensagens de erros
            [

                'txt.mimes' => 'Formato errado!',
                'image.image' => 'Precisa ser uma imagem',
                'image.mimes' => 'Precisa ser um arquivo png',
            ]
        );

        if($request->txt != null) {
            $request->txt->storeAs('public/userFiles', 'userTxt'.$user->id.'.txt');
        }
        if($request->image != null){
            $request->image->storeAs('public/userFiles', 'userImage'.$user->id.'.png');
        }
        
        return redirect('/dashboard')->with('msg', 'Arquivo(s) enviado(s) com sucesso!');
    }

    public function download($file){
        return response()->download('storage/userFiles/'.$file);
    }

    public function deleteFile($file){
        unlink(public_path('storage/userFiles/'.$file));
        return redirect('/dashboard')->with('msg', 'Arquivo removido com sucesso!');
    }
}