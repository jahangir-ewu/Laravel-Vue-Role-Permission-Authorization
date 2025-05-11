<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Users;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(User $user): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $targetdata): bool
    {
        return $user->can('user.view') ? true : false;
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('user.create') ? true : false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $targetdata): bool
    {
        return $user->can('user.edit') ? true : false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $targetdata): bool
    {
        return $user->can('user.delete') ? true : false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Users $users): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Users $users): bool
    {
        return false;
    }
}
