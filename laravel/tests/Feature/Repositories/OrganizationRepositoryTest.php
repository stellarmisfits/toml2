<?php

namespace Tests\Feature\Controllers\Organization;

use App\Models\Organization;
use App\Models\User;
use App\Repositories\OrganizationRepository;
use Illuminate\Validation\ValidationException;
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

        $this->assertDatabaseHas('accounts', [
            'id' => $asset->account->id,
            'organization_id' => $org->id
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

        $this->assertDatabaseHas('accounts', [
            'id' => $validator->account->id,
            'organization_id' => $org->id
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

        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'organization_id' => $org->id
        ]);

        $or->removeAccount($org, $account);

        $this->assertDatabaseMissing('organization_validators', [
            'organization_id' => $org->id,
            'validator_id' => $validator->id
        ]);

        $this->assertDatabaseMissing('organization_assets', [
            'organization_id' => $org->id,
            'asset_id' => $asset->id
        ]);

        $this->assertDatabaseMissing('accounts', [
            'id' => $account->id,
            'organization_id' => $org->id
        ]);
    }

    public function testOrganizationRepositoryPublishNoAccounts()
    {
        $or = new OrganizationRepository();
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $account    = $this->seeder->seedAccount($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $this->expectException(ValidationException::class);
        $or->publish($org);
    }

    public function testOrganizationRepositoryPublishAccountsNotValid()
    {
        $or = new OrganizationRepository();
        $team       = $this->seeder->seedTeam();
        $org        = $this->seeder->seedOrganization($team);
        $account    = $this->seeder->seedAccount($team);
        $user       = $this->seeder->seedUserWithTeam($team);
        $this->actingAs($user);

        $or->addAccount($org, $account);

        $this->expectException(ValidationException::class);
        $or->publish($org);
    }
}
