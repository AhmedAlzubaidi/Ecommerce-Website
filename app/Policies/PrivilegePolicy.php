<?php

namespace App\Policies;

use App\Privilege;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrivilegePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        return $user->ableTo('*');
    }
    
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Privilege  $privilege
     * @return mixed
     */
    public function view(User $user, Privilege $privilege)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Privilege  $privilege
     * @return mixed
     */
    public function update(User $user, Privilege $privilege)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Privilege  $privilege
     * @return mixed
     */
    public function delete(User $user, Privilege $privilege)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Privilege  $privilege
     * @return mixed
     */
    public function restore(User $user, Privilege $privilege)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Privilege  $privilege
     * @return mixed
     */
    public function forceDelete(User $user, Privilege $privilege)
    {
        return false;
    }
}
