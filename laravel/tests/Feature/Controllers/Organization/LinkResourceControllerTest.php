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
    public function testOrganizationControllerStore()
    {
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $account    = $this->seeder->seedAccount($team);
        $asset      = $this->seeder->seedAsset($team);
        $principal  = $this->seeder->seedPrincipal($team);
        $validator  = $this->seeder->seedValidator($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $response = $this->postJson('/api/organizations/' . $org->uuid . '/link', [
            'account_uuid' => $account->uuid,
            'asset_uuid' => $asset->uuid,
            'principal_uuid' => $principal->uuid,
            'validator_uuid' => $validator->uuid,
        ])
            ->assertStatus(201);

        $this->assertDatabaseHas('organization_accounts', [
            'organization_id' => $org->id,
            'account_id' => $account->id
        ]);

        $this->assertDatabaseHas('organization_assets', [
            'organization_id' => $org->id,
            'asset_id' => $asset->id
        ]);

        $this->assertDatabaseHas('organization_principals', [
            'organization_id' => $org->id,
            'principal_id' => $principal->id
        ]);

        $this->assertDatabaseHas('organization_validators', [
            'organization_id' => $org->id,
            'validator_id' => $validator->id
        ]);
    }

    /**
     * DELETE Resource
     */
    public function testAccountControllerDelete()
    {
        $or = new OrganizationRepository();
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $account    = $this->seeder->seedAccount($team);
        $asset      = $this->seeder->seedAsset($team);
        $principal  = $this->seeder->seedPrincipal($team);
        $validator  = $this->seeder->seedValidator($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $or->addAccount($org, $account);
        $or->addAsset($org, $asset);
        $or->addPrincipal($org, $principal);
        $or->addValidator($org, $validator);

        $response = $this->deleteJson('/api/organizations/' . $org->uuid . '/link', [
            'account_uuid' => $account->uuid,
            'asset_uuid' => $asset->uuid,
            'principal_uuid' => $principal->uuid,
            'validator_uuid' => $validator->uuid,
        ])
            ->assertStatus(201);

        $this->assertDatabaseMissing('organization_accounts', [
            'organization_id' => $org->id,
            'account_id' => $account->id
        ]);

        $this->assertDatabaseMissing('organization_assets', [
            'organization_id' => $org->id,
            'asset_id' => $asset->id
        ]);

        $this->assertDatabaseMissing('organization_principals', [
            'organization_id' => $org->id,
            'principal_id' => $principal->id
        ]);

        $this->assertDatabaseMissing('organization_validators', [
            'organization_id' => $org->id,
            'validator_id' => $validator->id
        ]);
    }
}
