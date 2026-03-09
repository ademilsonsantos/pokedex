<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Abilities;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AbilitiesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionEnum::POKEMON_VIEW->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Abilities $pokemon): bool
    {
        return $user->can(PermissionEnum::POKEMON_VIEW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionEnum::POKEMON_IMPORT->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Abilities $pokemon): bool
    {
        return $user->can(PermissionEnum::POKEMON_IMPORT->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Abilities $pokemon): bool
    {
        return $user->can(PermissionEnum::POKEMON_DELETE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Abilities $pokemon): bool
    {
        return $user->can(PermissionEnum::POKEMON_DELETE->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Abilities $pokemon): bool
    {
        return $user->can(PermissionEnum::POKEMON_DELETE->value);
    }
}
