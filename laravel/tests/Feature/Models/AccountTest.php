<?php

namespace Tests\Feature\Models;

use App\Repositories\OrganizationRepository;
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
    public function testTeamRelationship()
    {
        $account = $this->seeder->seedAccount();

        $result = $account->team;
        $this->assertEquals($account->team_id, $result->id);
    }

    /**
     *
     */
    public function testOrganizationRelationship()
    {
        $account = $this->seeder->seedAccount();
        $org = $this->seeder->seedOrganization($account->team);

        $or = new OrganizationRepository();
        $or->addAccount($org, $account);

        $this->assertEquals($org->id, $account->organizations->first()->id);
    }

    /**
     *
     */
    public function testAssetsRelationship()
    {
        $account = $this->seeder->seedAccount();
        $asset1 = $this->seeder->seedAsset($account->team, $account);
        $asset2 = $this->seeder->seedAsset($account->team, $account);

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
        $team = $this->seeder->seedTeam();
        $org1 = $this->seeder->seedOrganization($team);
        $org2 = $this->seeder->seedOrganization($team);

        $account1 = $this->seeder->seedAccount($team);
        $account2 = $this->seeder->seedAccount($team);

        $or = new OrganizationRepository();
        $or->addAccount($org1, $account1);
        $or->addAccount($org2 , $account2);

        $results = Account::organizationFilter($org1)->get();

        $this->assertCount(1, $results);
        $this->assertEquals($account1->id, $results[0]->id);
    }
}
