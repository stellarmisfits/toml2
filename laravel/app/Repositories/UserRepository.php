<?php

namespace App\Repositories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Two\User as SocialiteUser;

class UserRepository
{
    /**
     * @param SocialiteUser $socialiteUser
     * @return User
     */
    public function createFromSocialite(SocialiteUser $socialiteUser, $provider): User
    {
        return \DB::transaction(function () use ($socialiteUser, $provider) {

            // create user
            $user = new User();
            $user->name = $socialiteUser->getName();
            $user->email = $socialiteUser->getEmail();
            $user->email_verified_at = now();
            $user->save();

            // create team
            $team = new Team;
            $team->owner_id = $user->id;
            $team->name = 'Personal';
            $team->save();

            // create team_users
            $team->users()->attach($user, ['role' => 'OWNER']);

            // create oauth provider
            $user->oauthProviders()->create([
                'provider' => $provider,
                'provider_user_id' => $socialiteUser->getId(),
                'access_token' => $socialiteUser->token,
                'refresh_token' => $socialiteUser->refreshToken,
            ]);

            event(new Registered($user));

            return $user;
        });
    }
}
