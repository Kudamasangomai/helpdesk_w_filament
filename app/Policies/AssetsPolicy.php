<?php

namespace App\Policies;

use App\Models\asset;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AssetsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin; 
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Asset $asset)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user){
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Asset $asset)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Asset $asset)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Asset $asset)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Asset $asset)
    {
        //
    }
}
