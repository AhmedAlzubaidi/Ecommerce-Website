<?php

namespace App\Policies;

use App\ProductOption;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductOptionPolicy
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
     * @param  \App\ProductOption  $productOption
     * @return mixed
     */
    public function view(User $user, ProductOption $productOption)
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
     * @param  \App\ProductOption  $productOption
     * @return mixed
     */
    public function update(User $user, ProductOption $productOption)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProductOption  $productOption
     * @return mixed
     */
    public function delete(User $user, ProductOption $productOption)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProductOption  $productOption
     * @return mixed
     */
    public function restore(User $user, ProductOption $productOption)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProductOption  $productOption
     * @return mixed
     */
    public function forceDelete(User $user, ProductOption $productOption)
    {
        return false;
    }
}
