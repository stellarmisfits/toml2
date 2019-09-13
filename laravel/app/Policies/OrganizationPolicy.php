<?php

namespace App\Policies;

use App\Models\User;
use App\ModelsOrganization;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any models organizations.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the models organization.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ModelsOrganization  $modelsOrganization
     * @return mixed
     */
    public function view(User $user, ModelsOrganization $modelsOrganization)
    {
        //
    }

    /**
     * Determine whether the user can create models organizations.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the models organization.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ModelsOrganization  $modelsOrganization
     * @return mixed
     */
    public function update(User $user, ModelsOrganization $modelsOrganization)
    {
        //
    }

    /**
     * Determine whether the user can delete the models organization.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ModelsOrganization  $modelsOrganization
     * @return mixed
     */
    public function delete(User $user, ModelsOrganization $modelsOrganization)
    {
        //
    }

    /**
     * Determine whether the user can restore the models organization.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ModelsOrganization  $modelsOrganization
     * @return mixed
     */
    public function restore(User $user, ModelsOrganization $modelsOrganization)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the models organization.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ModelsOrganization  $modelsOrganization
     * @return mixed
     */
    public function forceDelete(User $user, ModelsOrganization $modelsOrganization)
    {
        //
    }
}
