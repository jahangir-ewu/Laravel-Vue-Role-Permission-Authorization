<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        return $user->can('project.view')
            ? Response::allow()
            : Response::deny('You do not have permission to view this project.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('project.create')
            ? Response::allow()
            : Response::deny('You do not have permission to create a project.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        /*return $user->hasPermissionTo('project.edit')
            ? Response::allow()
            : Response::deny('You do not have permission to edit this project.');*/

        return $user->can('project.edit')
            ? Response::allow()
            : Response::deny('You do not have permission to edit this project.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        return $user->can('project.delete')
            ? Response::allow()
            : Response::deny('You do not have permission to delete this project.');

            /*return $user->hasPermissionTo('project.delete')
                ? Response::allow()
                : Response::deny('You do not have permission to delete this project.');*/
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        return false;
    }
}
