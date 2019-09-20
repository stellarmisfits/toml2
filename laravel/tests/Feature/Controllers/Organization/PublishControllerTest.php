<?php

namespace Tests\Feature\Controllers\Organization;

use App\Models\Account;
use App\Models\Organization;
use App\Models\User;
use App\Repositories\OrganizationRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class PublishControllerTest extends TestCase
{

    /**
     * GET Collection
     */
    public function testPublishControllerStore()
    {
        $org = $this->seeder->seedOrganization();
        $user = $this->seeder->seedUserWithTeam($org->team);
        $this->actingAs($user);

        $org->published = false;
        $org->save();

        $this->postJson(route('organizations.publish', [
            $org->uuid
        ]))->assertStatus(200);

        $this->assertDatabaseHas('organizations', [
            'uuid'         => $org->uuid,
            'published'    => true,
        ]);
    }

    /**
     * DELETE Resource
     */
    public function testPublishControllerDelete()
    {
        $org = $this->seeder->seedOrganization();
        $user = $this->seeder->seedUserWithTeam($org->team);
        $this->actingAs($user);

        $org->published = true;
        $org->save();

        $this->deleteJson(route('organizations.unpublish', [
            $org->uuid
        ]))->assertStatus(200);

        $this->assertDatabaseHas('organizations', [
            'uuid'          => $org->uuid,
            'published'    => false,
        ]);
    }
}
