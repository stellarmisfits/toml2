<?php

namespace Tests\Feature\Models;

use Ramsey\Uuid\Uuid;
use Tests\TestCase;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    |
    |
    */

    //


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     *
     */
    public function testUsersRelationship()
    {
        $user = $this->seeder->seedUser();
        $account = $this->seeder->seedAccount();
        $account->users()->attach($user);

        $result = $account->users->first();
        $this->assertEquals($user->id, $result->id);
    }

    /**
     *
     */
    public function testOrganizationRelationship()
    {
        $org = $this->seeder->seedOrganization();
        $account = $this->seeder->seedAccount(null, $org);

        $this->assertEquals($org->id, $account->organization->id);
    }

    /**
     *
     */
    public function testAssetsRelationship()
    {
        $account = $this->seeder->seedAccount();
        $asset1 = $this->seeder->seedAsset($account);
        $asset2 = $this->seeder->seedAsset($account);

        $this->assertCount(2, $account->assets);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     *
     */
    public function testOrganizationScope()
    {
        $org1 = $this->seeder->seedOrganization();
        $org2 = $this->seeder->seedOrganization();

        $account1 = $this->seeder->seedAccount(null, $org1);
        $account2 = $this->seeder->seedAccount(null, $org2);

        $results = Account::organizationFilter($org1)->get();

        $this->assertCount(1, $results);
        $this->assertEquals($account1->id, $results[0]->id);

    }
}
