<?php

namespace App\Policies;

use App\Models\LaporanBarangHilang;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LaporanBarangHilangPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdministrator() || $user->isUser();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LaporanBarangHilang $laporanBarangHilang): bool
    {
        return $user->isAdministrator() || $user->isUser();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdministrator() || $user->isUser();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LaporanBarangHilang $laporanBarangHilang): bool
    {
        return true;// return $user->isAdministrator() || $user->id === $laporanBarangHilang->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LaporanBarangHilang $laporanBarangHilang): bool
    {
        return $user->isAdministrator() || $user->isUser();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LaporanBarangHilang $laporanBarangHilang): bool
    {
        return $user->isAdministrator() || $user->isUser();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LaporanBarangHilang $laporanBarangHilang): bool
    {
        return $user->isAdministrator() || $user->isUser();
    }
}
