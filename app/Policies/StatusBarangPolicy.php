<?php

namespace App\Policies;

use App\Models\StatusBarang;
use App\Models\User;

class StatusBarangPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function view(User $user, User $model): bool
    {
        return $user->isAdministrator();
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, StatusBarang $model): bool
    {
        return $user->isAdministrator();
    }

    public function delete(User $user, StatusBarang $model): bool
    {
        return $user->isAdministrator();
    }

    public function restore(User $user, StatusBarang $model): bool
    {
        return $user->isAdministrator();
    }

    public function forceDelete(User $user, StatusBarang $model): bool
    {
        return $user->isAdministrator();
    }

    public function restoreAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->isAdministrator();
    }
}
