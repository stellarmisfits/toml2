<?php

namespace Tests\Feature\Controllers\Api\User\Account;

use App\Models\Account;
use App\Models\Asset;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Http\Resources\Account as AccountResource;
use ZuluCrypto\StellarSdk\Keypair;

class AccountControllerTest extends TestCase
{

    /**
     * GET Collection
     */
    public function testAccountControllerIndex()
    {
        $account1 = $this->seeder->seedAccount();
        $user = $this->seeder->seedUserWithTeam($account1->team);
        $this->actingAs($user);

        $this->assertEquals($account1->team->id, $user->currentTeam()->id);
        $account2 = $this->seeder->seedAccount();

        $this->getJson(route('accounts.index'))
            ->assertStatus(200)
            ->assertJsonFragment((new AccountResource($account1))->toArray())
            ->assertJsonMissing([
                'uuid'      => $account2->id
            ]);
    }

    /**
     * POST
     */
    public function testAccountControllerStore()
    {
        $user = $this->seeder->seedUserWithTeam();
        $this->actingAs($user);
        $account = factory(Account::class)->make([
            'team_id' => $user->currentTeam()->id,
        ]);

        $this->assertDatabaseMissing('accounts', [
            'team_id' => $user->currentTeam()->id,
        ]);

        $response = $this->postJson(route('accounts.store'), $account->toArray())
            ->assertStatus(201);

        $this->assertDatabaseHas('accounts', [
            'team_id' => $user->currentTeam()->id
        ]);
    }

    /**
     * GET Resource
     */
    public function testAccountControllerShow()
    {
        $account = $this->seeder->seedAccount();
        $user = $this->seeder->seedUserWithTeam($account->team);
        $this->actingAs($user);

        $this->actingAs($user, 'api')
            ->getJson(route('accounts.show', [
                $account->uuid
            ]))
            ->assertStatus(200)
            ->assertJsonFragment((new AccountResource($account))->toArray());
    }
}
