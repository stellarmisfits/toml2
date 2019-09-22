<?php

namespace App\Models\Policies;

use App\Models\User;
use App\Models\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the account.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->email === 'admin@astrify.com') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the account.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function view(User $user, Account $account)
    {
        return $account->team_id === $user->currentTeam()->id;
    }

    /**
     * Determine whether the user can create accounts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        request()->input('team_id');
        return $user->hasVerifiedEmail();
    }

    /**
     * Determine whether the user can update the account.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function update(User $user, Account $account)
    {
        if ($user->email === 'admin@astrify.com') {
            return true;
        }

        return $user->id === $account->user_id;
    }

    /**
     * Determine whether the user can delete the account.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function delete(User $user, Account $account)
    {
        if ($user->email === 'admin@astrify.com') {
            return true;
        }

        return $user->id === $account->user_id;
    }
}
