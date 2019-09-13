<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Asset;
use App\Models\Organization;
use App\Models\Principal;
use App\Models\User;
use App\Models\Validator;

class OrganizationRepository
{

    /**
     * @param User $user
     * @param array $data
     * @return Organization
     */
    public function create(User $user, array $data): Organization
    {
        $o = new Organization();
        $o->team_id     = $user->currentTeam()->id;
        $o->alias       = str_slug($data['alias']);
        $o->name        = $data['name'];
        $o->published   = false;
        $o->save();

        // dispatch event to check whether the account is verified

        return $o;
    }

    /**
     *
     */
    public function addAccount(Organization $org, Account $account)
    {
        $org->accounts()->attach($account);
    }

    /**
     *
     */
    public function addAsset(Organization $org, Asset $asset)
    {
        $org->assets()->attach($asset);
    }

    /**
     *
     */
    public function addPrincipal(Organization $org, Principal $account)
    {
        $org->principals()->attach($account);
    }

    /**
     *
     */
    public function addValidator(Organization $org, Validator $validator)
    {
        $org->validators()->attach($validator);
    }
}
