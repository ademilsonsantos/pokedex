<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Role::class);
        $roles = Role::paginate(10);

        return view('permission.index', compact('roles'));
    }

    public function create()
    {
        Gate::authorize('create', Role::class);
        $permissions = PermissionEnum::cases();

        return view('permission.create', compact('permissions'));
    }

    public function store(PermissionRequest $request)
    {
        Gate::authorize('create', Role::class);
        $role = Role::findOrCreate($request->name);
        $role->syncPermissions($request->permissions);

        return redirect()->route('permission.index')->with('success', 'Permissão criada com sucesso!');
    }

    public function edit($id)
    {
        $role = Role::findById($id);
        Gate::authorize('update', $role);
        $permissions = PermissionEnum::cases();

        return view('permission.edit', compact('role', 'permissions'));
    }

    public function update(PermissionRequest $request, $id)
    {
        $role = Role::findById($id);
         Gate::authorize('update', $role);
        $role->revokePermissionTo($role->permissions);
        $role->syncPermissions($request->permissions);

        return redirect()->route('permission.index')->with('success', 'Permissão atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $role = Role::findById($id);
        Gate::authorize('delete', $role);
        $role->revokePermissionTo($role->permissions);
        $role->delete();

        return redirect()->route('permission.index')->with('success', 'Permissão deletada com sucesso!');
    }

    public function search(Request $request)
    {
        Gate::authorize('viewAny', Role::class);
        $roles = Role::where('name', 'like', "%{$request->name}%")->paginate(10);

        return view('permission.index', compact('roles'));
    }
}
