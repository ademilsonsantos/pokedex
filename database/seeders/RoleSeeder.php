<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleViewer = Role::findOrCreate('viewer');
        $roleEditor = Role::findOrCreate('editor');
        $roleAdmin = Role::findOrCreate('admin');

        foreach (PermissionEnum::cases() as $permission) Permission::findOrCreate($permission->value);

        $roleViewer->givePermissionTo(PermissionEnum::POKEMON_VIEW->value);

        $roleEditor->syncPermissions([
            PermissionEnum::POKEMON_IMPORT->value,
            PermissionEnum::POKEMON_FAVORITE->value,
        ]);

        $roleAdmin->syncPermissions([
            PermissionEnum::USER_CREATE->value,
            PermissionEnum::USER_VIEW->value,
            PermissionEnum::USER_UPDATE->value,
            PermissionEnum::USER_DELETE->value,
            PermissionEnum::ROLE_CREATE->value,
            PermissionEnum::ROLE_VIEW->value,
            PermissionEnum::ROLE_UPDATE->value,
            PermissionEnum::ROLE_DELETE->value,
            PermissionEnum::POKEMON_DELETE->value,
        ]);

        $userViewer = User::factory()->create([
            'name' => 'User viewer',
            'email' => 'viewer@example.com',
            'password' => 'password',
        ])->assignRole($roleViewer);

        $userEditor = User::factory()->create([
            'name' => 'User editor',
            'email' => 'editor@example.com',
            'password' => 'password',
        ])->assignRole($roleEditor);

        $userAdmin = User::factory()->create([
            'name' => 'User admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ])->assignRole($roleAdmin);
    }
}
