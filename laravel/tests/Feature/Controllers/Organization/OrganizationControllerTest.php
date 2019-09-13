<?php

namespace Tests\Feature\Controllers\Organization;

use App\Models\Organization;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class OrganizationControllerTest extends TestCase
{

    /**
     * GET Collection
     */
    public function testOrganizationControllerIndex()
    {
        $org1 = $this->seeder->seedOrganization();
        $user = $this->seeder->seedUserWithTeam($org1->team);
        $this->actingAs($user);

        $this->assertEquals($org1->team->id, $user->currentTeam()->id);

        $org2 = $this->seeder->seedOrganization();

        $this->getJson(route('organizations.index'))
            ->assertStatus(200)
            ->assertJsonFragment([
                'uuid'                => $org1->uuid,
                'name'              => $org1->name,
            ])
            ->assertJsonMissing([
                'uuid'      => $org2->uuid
            ]);
    }

    /**
     * POST
     */
    public function testOrganizationControllerStore()
    {
        $name = str_random(15);
        $slug = strtolower(str_random(15));

        $this->assertDatabaseMissing('organization_users', [
            'user_id' => $this->user->id
        ]);

        $this->assertDatabaseMissing('organizations', [
            'name' => $name,
            'slug' => $slug
        ]);

        $response = $this->postJson(
            route('organizations.store'),
            [
                'name' => $name,
                'slug' => $slug
            ]
        );
        $response->assertStatus(201);

        $this->assertDatabaseHas('organization_users', [
            'user_id' => $this->user->id
        ]);

        $this->assertDatabaseHas('organizations', [
            'name' => $name,
            'slug' => $slug
        ]);
    }

    /**
     * GET Collection
     */
    public function testOrganizationControllerShow()
    {
        $org = $this->seeder->seedOrganization();
        $user = $this->seeder->seedUserWithTeam($org->team);
        $this->actingAs($user);

        $this->getJson(route('organizations.show', [
            'uuid' => $org->uuid
        ]))
            ->assertStatus(200)
            ->assertJsonFragment([
                'uuid' => $org->uuid
            ]);
    }
}
