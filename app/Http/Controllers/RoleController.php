<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RolePermissionRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar perfis') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $roles = Role::all();

        return view('roles.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar perfis') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolePermissionRequest $request)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar perfis') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return redirect()->route('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar perfis') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $role = Role::where('id', $id)->first();

        return view('roles.edit', ['role' => $role, 'id' => $role->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolePermissionRequest $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar perfis') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $role = Role::where('id', $id)->first();
        $role->name = $request->name;
        $role->save();

        return redirect()->route('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar perfis') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $role = Role::where('id', $id);
        $role->delete();

        return redirect()->route('roles');
    }

    public function permissions($role)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar perfis') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $role = Role::where('id', $role)->first();

        $permissions = Permission::all();

        foreach($permissions as $permission) {
            if ($role->hasPermissionTo($permission->name)) {
                $permission->can = true;
            } else {
                $permission->can = false;
            }
        }
        
        return view('roles.permissions', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function permissionsSync(Request $request, $role)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciar perfis') && !Auth::user()->hasRole('Super Admin')){
            throw new UnauthorizedException('403', 'Você não tem permissão');
        }

        $permissionsRequest = $request->except(['_token', '_method']);

        foreach($permissionsRequest as $key => $value) {
            $permissions[] = Permission::where('id', $key)->first();
        }

        $role = Role::where('id', $role)->first();
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions(null);
        }

        return redirect()->route('role.permissions', ['role' => $role->id]);
    }
}
