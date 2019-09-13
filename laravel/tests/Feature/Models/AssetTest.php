<?php

namespace Tests\Feature\Models;

use App\Models\Account;
use App\Repositories\OrganizationRepository;
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
        $asset = $this->seeder->seedAsset($account->team, $account);

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
    public function testAccountScope()
    {
        $account = $this->seeder->seedAccount();
        $asset = $this->seeder->seedAsset($account->team, $account);

        $result = $asset::accountFilter($account)->first();
        $this->assertEquals($asset->id, $result->id);
    }

    /**
     *
     */
    public function testOrganizationScope()
    {
        $team = $this->seeder->seedTeam();
        $org1 = $this->seeder->seedOrganization($team);
        $org2 = $this->seeder->seedOrganization($team);

        $account1 = $this->seeder->seedAccount($team);
        $account2 = $this->seeder->seedAccount($team);
        $asset1 = $this->seeder->seedAsset($team, $account1);
        $asset2 = $this->seeder->seedAsset($team, $account2);

        $or = new OrganizationRepository();
        $or->addAsset($org1, $asset1);
        $or->addAsset($org2, $asset2);

        $results = $assets = Asset::with(['account'])
            ->organizationFilter($org1)
            ->get();

        $this->assertCount(1, $results);
        $this->assertEquals($asset1->id, $results[0]->id);
    }
}
