<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Asset;
use App\Models\Organization;
use App\Models\Principal;
use App\Models\User;
use App\Models\Validator;
use Illuminate\Validation\ValidationException;
use ZuluCrypto\StellarSdk\Model\Account as StellarAccount;

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
        $a->name        = $data['name'];
        $a->alias       = str_slug($data['alias']);
        $a->public_key  = strtoupper($data['public_key']);
        $a->save();

        // dispatch event to check whether the account is verified

        return $a;
    }

    /**
     * @param Account $account
     * @param StellarAccount $sAccount
     * @throws
     */
    public function verify(Account $account, StellarAccount $sAccount)
    {
        $home_domain = $sAccount->getHomeDomain();

        throw_unless($account->organization, ValidationException::withMessages([
            'account_uuid' => 'This account is not associated with an organization.'
        ]));

        throw_unless($account->organization->url === $home_domain, ValidationException::withMessages([
            'account_uuid' => 'The home domain for the given account does not match the organization\'s url.'
        ]));

        $account->home_domain = $home_domain;
        $account->home_domain_updated_at = now();
        $account->save();
    }
}
