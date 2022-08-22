<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\LimitRequest;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Exceptions\UnauthorizedException;

class UserController extends Controller
{
    public $usersPerPage;

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $usersPerPage = request('usersPerPage');
        $numberUsers = $usersPerPage ? $usersPerPage : 10;

        $users = User::paginate($numberUsers);

        $createdUsers = User::where('created_at', '2022-07-08 17:01:52')->paginate(10);
        $toUsers = User::where('name', 'LIKE', 'To%')->paginate(10);

        $specificUsers = User::where([['name', 'LIKE', '%a%'], ['created_at', '2022-07-08 17:01:52']])
            ->orderBy('name', 'desc')
            ->paginate(10);

        return view('users.index', [
            'numberUsers' => $numberUsers,
            'users' => $users,
            'createdUsers' => $createdUsers,
            'toUsers' => $toUsers,
            'specificUsers' => $specificUsers,
        ]);
    }

    public function create()
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('users');
    }

    public function show()
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $this->usersPerPage = filter_input(INPUT_POST, "usersPerPage", FILTER_SANITIZE_NUMBER_INT);

        return view('users.index', ['users' => $users]);
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $user = User::where('id', $id)->first();

        return view('users.edit', ['user' => $user, 'id' => $user->id]);
    }

    public function update(UserEditRequest $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;

        if(!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users');
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $user = User::where('id', $id);
        $user->delete();

        return redirect()->route('users');
    }

    public function roles($user)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $user = User::where('id', $user)->first();

        $roles = Role::all();

        foreach($roles as $role) {
            if ($user->hasRole($role->name)) {
                $role->can = true;
            } else {
                $role->can = false;
            }
        }

        return view('users.roles', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function rolesSync(Request $request, $user)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar usuários') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $rolesRequest = $request->except(['_token', '_method']);

        foreach($rolesRequest as $key => $value) {
            $roles[] = Role::where('id', $key)->first();
        }

        $user = User::where('id', $user)->first();
        if(!empty($roles)){
            $user->syncRoles($roles);
        } else {
            $user->syncRoles(null);
        }

        return redirect()->route('user.roles', ['user' => $user->id]);
    }
}
