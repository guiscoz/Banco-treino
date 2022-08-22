<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RolePermissionRequest;
use App\Models\Account;
use App\Models\User;

class AccountDisplayController extends Controller
{
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $users = User::select(['id', 'name'])->get();

        return view('account_display.index', compact('users'));
    }

    public function bank_list($userId) {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
           throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $banks = Account::where('user_id', $userId)->get();
        //dd($banks);

        return response()->json($banks);
    }

    public function user_account($bankId) {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $account = Account::where('id', $bankId)->first();

        return response()->json($account);
    }
}
