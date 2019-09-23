<?php

namespace Tests\Feature\Controllers\Organization;

use App\Models\Organization;
use App\Models\User;
use App\Repositories\OrganizationRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class OrganizationRepositoryTest extends TestCase
{
    public function testOrganizationRepositoryAddAsset()
    {
        $or = new OrganizationRepository();
        $team = $this->seeder->seedTeam();
        $org = $this->seeder->seedOrganization($team);
        $asset = $this->seeder->seedAsset($team);
        $user = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $or->addAsset($org, $asset);

        $this->assertDatabaseHas('organization_assets', [
            'organization_id' => $org->id,
            'asset_id' => $asset->id
        ]);

        $this->assertDatabaseHas('organization_accounts', [
            'organization_id' => $org->id,
            'account_id' => $asset->account->id
        ]);
    }

    public function testOrganizationRepositoryAddValidator()
    {
        $or = new OrganizationRepository();
        $team = $this->seeder->seedTeam();
        $org = $this->seeder->seedOrganization($team);
        $validator = $this->seeder->seedValidator($team);
        $user = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $or->addValidator($org, $validator);

        $this->assertDatabaseHas('organization_validators', [
            'organization_id' => $org->id,
            'validator_id' => $validator->id
        ]);

        $this->assertDatabaseHas('organization_accounts', [
            'organization_id' => $org->id,
            'account_id' => $validator->account->id
        ]);
    }

    public function testOrganizationRepositoryRemoveAccountAsset()
    {
        $or = new OrganizationRepository();
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $account    = $this->seeder->seedAccount($team);
        $asset      = $this->seeder->seedAsset($team, $account);
        $validator  = $this->seeder->seedValidator($team, $account);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $or->addAsset($org, $asset);
        $or->addAccount($org, $account);
        $or->addValidator($org, $validator);

        $or->removeAccount($org, $account);

        $this->assertDatabaseMissing('organization_validators', [
            'organization_id' => $org->id,
            'validator_id' => $validator->id
        ]);

        $this->assertDatabaseMissing('organization_assets', [
            'organization_id' => $org->id,
            'asset_id' => $asset->id
        ]);

        $this->assertDatabaseMissing('organization_accounts', [
            'organization_id' => $org->id,
            'account_id' => $account->id
        ]);
    }
}
