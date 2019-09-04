<?php

use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\User;
use App\Models\Asset;
use App\Models\Principal;
use App\Models\Organization;
use Ramsey\Uuid\Uuid;
use ZuluCrypto\StellarSdk\Keypair;
use Base32\Base32;

class TestCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }

    /*
    |--------------------------------------------------------------------------
    | User Seeders
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * @return User
     */
    public function seedUser(): User {
        $user = factory(User::class)->create();
        return $user;
    }

    /**
     * @param Account $account
     * @return User
     * @throws
     */
    public function seedUserWithAccount(Account $account = null): User {
        if(!$account){
            $account = $this->seedAccount();
        }

        $user = $this->seedUser();
        $account->users()->attach($user, ['id' => Uuid::uuid4()]);

        return $user;
    }

    /**
     * @param Organization $org
     * @return User
     * @throws
     */
    public function seedUserWithOrganization(Organization $org = null): User {
        $user = $this->seedUser();

        if(!$org){
            $org = $this->seedOrganization();
        }

        $user->organizations()->attach($org);

        return $user;
    }

    /*
    |--------------------------------------------------------------------------
    | Account Seeders
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * @param Organization $org
     * @param Keypair $keypair
     * @return Account
     */
    public function seedAccount(Keypair $keypair = null, Organization $org = null): Account {
        if(!$org) {
            $org = $this->seedOrganization();
        }

        if(!$keypair){
            $keypair = Keypair::newFromRawSeed(str_random(32));
        }

        $account = factory(Account::class)->create([
            'public_key' => $keypair->getAccountId(),
            'organization_id' => $org->id,
        ]);

        return $account->fresh();
    }

    /**
     * @param Asset $asset
     * @param Keypair $keypair
     * @return Account
     */
    public function seedAccountWithAsset(Asset $asset = null, Keypair $keypair = null): Account {
        $account = $this->seedAccount($keypair);

        if(!$asset){
            $asset = $this->seedAsset($account);
        }

        return $account->fresh();
    }

    /*
    |--------------------------------------------------------------------------
    | Organization Seeders
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * @return Organization
     */
    public function seedOrganization(): Organization {
        $org = factory(Organization::class)->create();

        return $org->fresh();
    }

    /**
     * @param Account $account
     * @return Organization
     * @throws
     */
    public function seedOrganizationWithAccount(Account $account = null): Organization {
        $org = factory(Organization::class)->create();

        if(!$account){
            $this->seedAccount(null, $org);
        }

        return $org->fresh();
    }

    /**
     * @param Account $account
     * @return Organization
     * @throws
     */
    public function seedOrganizationWithPrincipal(Principal $principal = null): Organization {
        $org = factory(Organization::class)->create();

        if(!$principal){
            $principal = $this->seedPrincipal($org);
        }

        return $org;
    }

    /*
    |--------------------------------------------------------------------------
    | Asset Seeders
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * @param Account $account
     * @return Asset
     */
    public function seedAsset(Account $account = null): Asset {
        if(!$account){
            $account = $this->seedAccount();
        }

        $asset = factory(Asset::class)->create([
            'account_id' => $account->id
        ]);

        return $asset->fresh();
    }

    /*
    |--------------------------------------------------------------------------
    | Principal Seeders
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * @param Organization $org
     * @return Principal
     */
    public function seedPrincipal(Organization $org): Principal {
        if(!$org){
            $org = $this->seedOrganization();
        }

        $principal = factory(Principal::class)->create([
            'organization_id' => $org->id
        ]);
        return $principal->fresh();
    }
}
