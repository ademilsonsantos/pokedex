<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);

        return view('permission.index', compact('roles'));
    }

    public function create()
    {
        $permissions = PermissionEnum::cases();

        return view('permission.create', compact('permissions'));
    }

    public function store(PermissionRequest $request)
    {
        // Logic to store a new permission
    }

    public function show($id)
    {
        // Logic to show a specific permission
    }

    public function edit($id)
    {
        // Logic to show the edit form for a specific permission
    }

    public function update(Request $request, $id)
    {
        // Logic to update a specific permission
    }

    public function destroy($id)
    {
        // Logic to delete a specific permission
    }
}
