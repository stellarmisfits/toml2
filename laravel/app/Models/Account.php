<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Account extends BaseModel
{

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    |
    |
    */

    //

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Account->Users relationship
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'account_users');
    }


    /**
     * Account->Organization relationship
     *
     * @return BelongsTo
     */
    public function organization(): BelongsTo {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Account->Assets relationship
     *
     * @return HasMany
     */
    public function assets(): HasMany {
        return $this->hasMany(Asset::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * @param Builder $query
     * @param string $public_key
     * @return Builder
     */
    public function scopePublicKeyFilter($query, string $public_key = null) {

        if(!empty($public_key)){
            $query->where('public_key', $public_key->id);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param Organization $organization
     * @return Builder
     */
    public function scopeOrganizationFilter($query, Organization $organization) {

        if(!empty($organization)){
            $query->where('organization_id', $organization->id);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param string $organization_id
     * @return Builder
     */
    public function scopeOrganizationIdFilter($query, string $organization_id = null) {

        if(!empty($organization_id)){
            $query->where('organization_id', $organization_id);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param Asset $asset
     * @return Builder
     */
    public function scopeAssetFilter($query, Asset $asset) {

        if(!empty($asset)){
            $query->whereHas('assets', function($query) use($asset) {
                $query->where('assets.id', $asset->id);
            });
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param User $user
     * @return Builder
     */
    public function scopeVerifiedFilter($query,  ?User $user) {

        $query->where(function ($query) use ($user) {
            $query->where('verified', true);

            if($user){
                $query->orWhere('user_id', $user->id);
            }
        });

        return $query;
    }
}
