<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Asset;
use App\Models\Organization;
use App\Models\Principal;
use App\Models\User;
use App\Models\Validator;

class AccountRepository
{
    /**
     * @param User $user
     * @return Account
     */
    public function create(User $user, $data): Account
    {
        $a = new Account();
        $a->team_id     = $user->currentTeam()->id;
        $a->alias       = str_slug($data['alias']);
        $a->public_key  = strtoupper($data['public_key']);
        $a->verified     = false;
        $a->save();

        // dispatch event to check whether the account is verified

        return $a;
    }
}
