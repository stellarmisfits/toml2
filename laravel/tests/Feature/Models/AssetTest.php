<?php

namespace Tests\Feature\Models;

use App\Models\Account;
use App\Models\Organization;
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
    public function testAccountUuidFilter()
    {
        $account = $this->seeder->seedAccount();
        $asset = $this->seeder->seedAsset($account->team, $account);

        $result = $asset::accountUuidFilter($account)->first();
        $this->assertEquals($asset->id, $result->id);
    }

    /**
     *
     */
    public function testOrganizationUuidFilter()
    {
        $team  = $this->seeder->seedTeam();
        $asset1 = $this->seeder->seedAsset($team);
        $asset2= $this->seeder->seedAsset($team);
        $org   = $this->seeder->seedOrganization($team);

        $or = new OrganizationRepository();
        $or->addAsset($org, $asset1);

        $results = (new Asset())->organizationUuidFilter($org->uuid)->get();
        $this->assertCount(1, $results);
        $this->assertEquals($asset1->id, $results[0]->id);
    }
}
