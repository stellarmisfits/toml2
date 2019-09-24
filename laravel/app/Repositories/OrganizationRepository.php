<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Asset;
use App\Models\Organization;
use App\Models\Principal;
use App\Models\User;
use App\Models\Validator;
use Illuminate\Validation\ValidationException;

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
     * @param Organization $org
     * @param Account $account
     */
    public function addAccount(Organization $org, Account $account)
    {
        $org->accounts()->syncWithoutDetaching($account);
    }


    /**
     * @param Organization $org
     * @param Account $account
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
     * @param Organization $org
     * @param Asset $asset
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
     * @param Organization $org
     * @param Principal $account
     */
    public function addPrincipal(Organization $org, Principal $account)
    {
        $org->principals()->syncWithoutDetaching($account);
    }


    /**
     * @param Organization $org
     * @param Validator $validator
     */
    public function addValidator(Organization $org, Validator $validator)
    {
        \DB::transaction(function () use ($org, $validator) {
            // automatically attach the asset's account
            $org->accounts()->syncWithoutDetaching($validator->account);

            $org->validators()->syncWithoutDetaching($validator);
        });
    }

    /**
     * @param Organization $organization
     * @throws
     */
    public function publish(Organization $organization) {
        $accounts = $organization->accounts;

        throw_unless($accounts->count(), ValidationException::withMessages([
            'organization_uuid' => 'The given organization is not associated with any accounts and therefore cannot be published.'
        ]));

        $accounts->each(function($account) use ($organization){
            throw_unless($account->verified, ValidationException::withMessages([
                'organization_uuid' => 'All associated accounts have not been verified. All accounts tied to this organization must have their home directory set to  ' . $organization->url . ' prior to publishing.'
            ]));
        });


        $organization->published = true;
        $organization->save();
    }
}
