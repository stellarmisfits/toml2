<?php

namespace Tests\Feature\Controllers\Api\User\Account;

use App\Models\Account;
use App\Models\Asset;
use App\Models\User;
use Tests\TestCase;
use Laravel\Passport\Passport;
use ZuluCrypto\StellarSdk\Keypair;

class AccountValidationControllerTest extends TestCase
{
    /**
     * @var User
     */
    public $user;

    /**
     *
     */
    public function testStore()
    {
        $keypair = Keypair::newFromSeed(config('stellar.accounts.LOTTO_GELATO.secret'));

        $account = Account::where('name', 'Lotto\' Gelato')->first();
        $account->verified = false;
        $account->save();

        $user = $account->user;
        $this->actingAs($user, 'api');

        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'verified' => false
        ]);

        $response = $this->postJson(route('accounts.validate', $account->id));
        $response->assertStatus(200);

        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'verified' => true
        ]);
    }
}
