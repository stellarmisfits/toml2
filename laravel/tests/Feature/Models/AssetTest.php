<?php

namespace Tests\Feature\Models;

use App\Models\Account;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;
use App\Models\Asset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Query\Builder;

class AssetTest extends TestCase
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
     * A basic test example.
     */
    public function testAccountRelationship()
    {
        $account = $this->seeder->seedAccount();
        $asset = $this->seeder->seedAsset($account);

        $this->assertEquals($account->id, $asset->account->id);
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
    public function testUserScope()
    {
        $user = $this->seeder->seedUser();
        $account = $this->seeder->seedAccount();
        $account->users()->attach($user);
        $asset = $this->seeder->seedAsset($account);

        $result = $asset::userFilter($user)->first();
        $this->assertEquals($asset->id, $result->id);
    }

    /**
     *
     */
    public function testAccountIdScope()
    {
        $account1 = $this->seeder->seedAccount();
        $account2 = $this->seeder->seedAccount();
        $asset1 = $this->seeder->seedAsset($account1);
        $asset2 = $this->seeder->seedAsset($account2);

        $results = $assets = Asset::accountIdFilter($account1->id)
            ->get();

        $this->assertCount(1, $results);
        $this->assertEquals($asset1->id, $results[0]->id);

    }

    /**
     *
     */
    public function testOrganizationScope()
    {
        $org1 = $this->seeder->seedOrganization();
        $org2 = $this->seeder->seedOrganization();

        $account1 = $this->seeder->seedAccount(null, $org1);
        $account2 = $this->seeder->seedAccount(null, $org2);
        $asset1 = $this->seeder->seedAsset($account1);
        $asset2 = $this->seeder->seedAsset($account2);

        $results = $assets = Asset::with(['account'])
            ->organizationFilter($org1)
            ->get();

        $this->assertCount(1, $results);
        $this->assertEquals($asset1->id, $results[0]->id);
    }

}
