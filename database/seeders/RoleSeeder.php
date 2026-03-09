<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roleViewer = Role::findOrCreate('viewer');
        $roleEditor = Role::findOrCreate('editor');
        $roleAdmin = Role::findOrCreate('admin');

        $roleViewer->givePermissionTo(PermissionEnum::POKEMON_VIEW->value);

        $roleEditor->syncPermissions([
            PermissionEnum::POKEMON_VIEW->value,
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
            PermissionEnum::POKEMON_VIEW->value,
            PermissionEnum::POKEMON_IMPORT->value,
            PermissionEnum::POKEMON_FAVORITE->value,
        ]);

        $userViewer = User::factory()->create([
            'name' => 'Viewer User',
            'email' => 'viewer@example.com',
            'password' => Hash::make('password'),
        ])->assignRole($roleViewer);

        $userEditor = User::factory()->create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => Hash::make('password'),
        ])->assignRole($roleEditor);

        $userAdmin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ])->assignRole($roleAdmin);
    }
}
