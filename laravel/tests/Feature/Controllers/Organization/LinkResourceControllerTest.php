<?php

namespace Tests\Feature\Controllers\Organization;

use App\Models\Organization;
use App\Models\User;
use App\Repositories\OrganizationRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class LinkResourceControllerTest extends TestCase
{

    /**
     * POST
     */
    public function testOrganizationControllerStoreAccount()
    {
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $account    = $this->seeder->seedAccount($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $this->assertDatabaseMissing('organization_accounts', [
            'organization_id' => $org->id,
            'account_id' => $account->id
        ]);

        $response = $this->postJson('/api/organizations/' . $org->uuid . '/link', [
            'resource_uuid' => $account->uuid,
            'resource_type' => 'account'
        ])
            ->assertStatus(201);

        $this->assertDatabaseHas('organization_accounts', [
            'organization_id' => $org->id,
            'account_id' => $account->id
        ]);
    }


    /**
     * POST
     */
    public function testOrganizationControllerStoreAsset()
    {
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $asset    = $this->seeder->seedAsset($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $this->assertDatabaseMissing('organization_assets', [
            'organization_id' => $org->id,
            'asset_id' => $asset->id
        ]);

        $response = $this->postJson('/api/organizations/' . $org->uuid . '/link', [
            'resource_uuid' => $asset->uuid,
            'resource_type' => 'asset'
        ])
            ->assertStatus(201);

        $this->assertDatabaseHas('organization_assets', [
            'organization_id' => $org->id,
            'asset_id' => $asset->id
        ]);
    }

    /**
     * POST
     */
    public function testOrganizationControllerStorePrincipal()
    {
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $principal    = $this->seeder->seedPrincipal($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $this->assertDatabaseMissing('organization_principals', [
            'organization_id' => $org->id,
            'principal_id' => $principal->id
        ]);

        $response = $this->postJson('/api/organizations/' . $org->uuid . '/link', [
            'resource_uuid' => $principal->uuid,
            'resource_type' => 'principal'
        ])
            ->assertStatus(201);

        $this->assertDatabaseHas('organization_principals', [
            'organization_id' => $org->id,
            'principal_id' => $principal->id
        ]);
    }

    /**
     * POST
     */
    public function testOrganizationControllerStoreValidator()
    {
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $validator    = $this->seeder->seedValidator($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $this->assertDatabaseMissing('organization_validators', [
            'organization_id' => $org->id,
            'validator_id' => $validator->id
        ]);

        $response = $this->postJson('/api/organizations/' . $org->uuid . '/link', [
            'resource_uuid' => $validator->uuid,
            'resource_type' => 'validator'
        ])
            ->assertStatus(201);

        $this->assertDatabaseHas('organization_validators', [
            'organization_id' => $org->id,
            'validator_id' => $validator->id
        ]);
    }

    /**
     * DELETE Resource
     */
    public function testResourceLinkControllerDeleteAccount()
    {
        $or = new OrganizationRepository();
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $account    = $this->seeder->seedAccount($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $or->addAccount($org, $account);

        $this->assertDatabaseHas('organization_accounts', [
            'organization_id' => $org->id,
            'account_id' => $account->id
        ]);

        $response = $this->deleteJson('/api/organizations/' . $org->uuid . '/link', [
            'resource_uuid' => $account->uuid,
            'resource_type' => 'account'
        ])
            ->assertStatus(204);

        $this->assertDatabaseMissing('organization_accounts', [
            'organization_id' => $org->id,
            'account_id' => $account->id
        ]);
    }

    /**
     * DELETE Resource
     */
    public function testResourceLinkControllerDeleteAsset()
    {
        $or = new OrganizationRepository();
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $asset    = $this->seeder->seedAsset($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $or->addAsset($org, $asset);

        $this->assertDatabaseHas('organization_assets', [
            'organization_id' => $org->id,
            'asset_id' => $asset->id
        ]);

        $response = $this->deleteJson('/api/organizations/' . $org->uuid . '/link', [
            'resource_uuid' => $asset->uuid,
            'resource_type' => 'asset'
        ])
            ->assertStatus(204);

        $this->assertDatabaseMissing('organization_assets', [
            'organization_id' => $org->id,
            'asset_id' => $asset->id
        ]);
    }

    /**
     * DELETE Resource
     */
    public function testResourceLinkControllerDeletePrincipal()
    {
        $or = new OrganizationRepository();
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $principal    = $this->seeder->seedPrincipal($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $or->addPrincipal($org, $principal);

        $this->assertDatabaseHas('organization_principals', [
            'organization_id' => $org->id,
            'principal_id' => $principal->id
        ]);

        $response = $this->deleteJson('/api/organizations/' . $org->uuid . '/link', [
            'resource_uuid' => $principal->uuid,
            'resource_type' => 'principal'
        ])
            ->assertStatus(204);

        $this->assertDatabaseMissing('organization_principals', [
            'organization_id' => $org->id,
            'principal_id' => $principal->id
        ]);
    }

    /**
     * DELETE Resource
     */
    public function testResourceLinkControllerDeleteValidator()
    {
        $or = new OrganizationRepository();
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $validator    = $this->seeder->seedValidator($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $or->addValidator($org, $validator);

        $this->assertDatabaseHas('organization_validators', [
            'organization_id' => $org->id,
            'validator_id' => $validator->id
        ]);

        $response = $this->deleteJson('/api/organizations/' . $org->uuid . '/link', [
            'resource_uuid' => $validator->uuid,
            'resource_type' => 'validator'
        ])
            ->assertStatus(204);

        $this->assertDatabaseMissing('organization_validators', [
            'organization_id' => $org->id,
            'validator_id' => $validator->id
        ]);
    }
}
