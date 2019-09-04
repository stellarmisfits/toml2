<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
// use Spatie\Image\Manipulations;
// use Spatie\MediaLibrary\Models\Media;
// use Spatie\MediaLibrary\HasMedia\HasMedia;
// use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Asset extends BaseModel // implements HasMedia
{
    // use HasMediaTrait;

    protected $fillable = [
        'code',
        'account_id',
        'display_decimals',
        'name',
        'desc',
        'details',
        'conditions',
        'redemption_instructions',
    ];

    public function registerMediaCollections()
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('image')
            ->fit(Manipulations::FIT_CROP, 250, 250)
            ->performOnCollections('image');
    }

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
     * Asset->Account relationship
     *
     * @return BelongsTo
     */
    public function account(): BelongsTo {
        return $this->belongsTo(Account::class);
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
     * @param User $user
     * @return Builder
     */
    public function scopeUserFilter(Builder $query, User $user = null) {

        if(!empty($user)){
            $query->whereHas('account.users', function($query) use($user) {
                $query->where('users.id', $user->id);
            });
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param string $keypair_id
     * @return Builder
     */
    public function scopeAccountIdFilter(Builder $query, $account_id) {

        if(!empty($account_id)){
            $query->where('account_id', $account_id);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param Organization $organization
     * @return Builder
     */
    public function scopeOrganizationFilter(Builder $query, Organization $organization) {

        if(!empty($organization)){
            $query->whereHas('account', function($query) use($organization) {
                $query->where('organization_id', $organization->id);
            });
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param string $code
     * @return Builder
     */
    public function scopeCodeFilter(Builder $query, $code) {

        if(!empty($code)){
            $query->where('code', $code);
        }

        return $query;
    }
}
