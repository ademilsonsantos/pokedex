<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', User::class);
        $users = User::paginate(10);

        return view('user.index', compact('users'));
    }

    public function create()
    {
        Gate::authorize('create', User::class);
        $roles = Role::all();

        return view('user.create', compact('roles'));
    }

    public function store(CreateUserRequest $request) {
        Gate::authorize('create', User::class);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($request->has('roles')) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('user.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {
        Gate::authorize('create', User::class);
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('user.edit', compact('user', 'roles'));
    }

    public function update($id, UpdateUserRequest $request) {
        $user = User::findOrFail($id);
        Gate::authorize('update', $user);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        return redirect()->route('user.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        Gate::authorize('delete', $user);

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
