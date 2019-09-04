<?php

namespace Tests\Feature\Models;

use App\Models\Organization;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganizationTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     *
     */
//    public function testLogoAttribute()
//    {
//        $filename = 'gelato-logo.jpg';
//        $logo = storage_path('fixtures/' . $filename);
//
//        $user = $this->seeder->seedUserWithOrganization();
//        $org = $user->organizations()->first();
//
//        $org->addMedia($logo)
//            ->preservingOriginal()
//            ->toMediaCollection('logo');
//
//
//        $this->assertContains('gelato-logo', $org->logo);
//    }

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
    public function testUsersRelationship()
    {
        $org = factory(Organization::class)->create();
        $user = $this->seeder->seedUser();

        $org->users()->attach($user);
        $result = $org->users->first();

        $this->assertCount(1, $org->users);
        $this->assertEquals($user->id, $result->id);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * A basic test example.
     */
    public function testUsersFilter()
    {
        $org1 = factory(Organization::class)->create();
        $user1 = $this->seeder->seedUser();
        $org1->users()->attach($user1);

        $org2 = factory(Organization::class)->create();
        $user2 = $this->seeder->seedUser();
        $org2->users()->attach($user2);


        $results = (new Organization)->userFilter($user1)->get();
        $this->assertCount(1, $results);
        $this->assertEquals($org1->id, $results[0]->id);
    }
}
