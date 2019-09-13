<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get all of the organizations that the asset belongs to.
     */
    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(
            Organization::class,
            'organization_assets',
            'asset_id',
            'organization_id'
        )->orderBy('name', 'asc');
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
     * @param Team $team
     * @return Builder
     */
    public function scopeTeamFilter(Builder $query, Team $team = null)
    {
        if (!empty($team)) {
            $query->where('team_id', $team->id);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param Account $account
     * @return Builder
     */
    public function scopeAccountFilter(Builder $query, Account $account)
    {
        if (!empty($account)) {
            $query->where('account_id', $account->id);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param Organization $organization
     * @return Builder
     */
    public function scopeOrganizationFilter(Builder $query, Organization $organization)
    {

        if (!empty($organization)) {
            $query->whereHas('organizations', function ($query) use ($organization) {
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
    public function scopeCodeFilter(Builder $query, $code)
    {

        if (!empty($code)) {
            $query->where('code', $code);
        }

        return $query;
    }
}
