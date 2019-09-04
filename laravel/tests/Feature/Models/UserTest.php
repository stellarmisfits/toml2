<?php

namespace Tests\Feature\Models;

use App\Models\Organization;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
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
    public function testAccountsRelationship()
    {
        $user = $this->seeder->seedUser();
        $account1 = $this->seeder->seedAccount();
        $account1->users()->attach($user);

        $account2 = $this->seeder->seedAccount();
        $user->accounts()->attach($account2);

        $this->assertCount(2, $user->accounts);
    }

    /**
     *
     */
    public function testOrganizationsRelationship()
    {
        $user = $this->seeder->seedUser();
        $org1 = factory(Organization::class)->create();
        $org1->users()->attach($user);
        $this->assertEquals($user->id, $org1->users->first()->id);

        $org2 = factory(Organization::class)->create();
        $user->organizations()->attach($org2);
        $this->assertEquals($user->id, $org2->users->first()->id);

        $this->assertCount(2, $user->organizations);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    |
    */
}
