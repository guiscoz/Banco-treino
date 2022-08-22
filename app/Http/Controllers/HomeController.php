<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Account;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){

        $accounts = Account::all();
        $user = auth()->user();

        return view('welcome', ['accounts' => $accounts, 'user' => $user]);
    }

    public function dashboard() {
        $user = auth()->user();
        $accounts = $user->accounts;

        return view ('dashboard', ['accounts' => $accounts]);
    }
}
