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
        $org->accounts()->syncWithoutDetaching($account);
    }

    /**
     *
     */
    public function removeAccount(Organization $org, Account $account)
    {
        \DB::transaction(function () use ($org, $account) {

            // detach any assets tied to the account
            $assets = $account->assets;
            if ($assets){
                $org->assets()->detach($assets->pluck('id')->toArray());
            }

            // detach any validators tied to the account
            $validators = $account->validators;
            if ($validators){
                $org->validators()->detach($validators->pluck('id')->toArray());
            }

            // detach the account
            $org->accounts()->detach($account);
        });
    }

    /**
     *
     */
    public function addAsset(Organization $org, Asset $asset)
    {
        \DB::transaction(function () use ($org, $asset) {
            // automatically attach the asset's account
            $org->accounts()->syncWithoutDetaching($asset->account);

            $org->assets()->syncWithoutDetaching($asset);
        });
    }

    /**
     *
     */
    public function addPrincipal(Organization $org, Principal $account)
    {
        $org->principals()->syncWithoutDetaching($account);
    }

    /**
     *
     */
    public function addValidator(Organization $org, Validator $validator)
    {
        \DB::transaction(function () use ($org, $validator) {
            // automatically attach the asset's account
            $org->accounts()->syncWithoutDetaching($validator->account);

            $org->validators()->syncWithoutDetaching($validator);
        });
    }
}
