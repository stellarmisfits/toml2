<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Asset;
use App\Models\Organization;
use App\Models\Principal;
use App\Models\Validator;

class OrganizationRepository
{
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
