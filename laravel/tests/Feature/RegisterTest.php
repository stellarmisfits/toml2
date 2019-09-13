<?php

namespace Tests\Feature;

use App\Models\User ;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /** @test */
    public function canRegister()
    {
        $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@test.app',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])
        ->assertSuccessful()
        ->assertJsonStructure(['uuid', 'name', 'email']);
    }

    /** @test */
    public function canNotRegisterWithExistingEmail()
    {
        factory(User::class)->create(['email' => 'test@test.app']);

        $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@test.app',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
    }
}
