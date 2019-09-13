<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Query\Builder;

// use Spatie\Image\Manipulations;
// use Spatie\MediaLibrary\Models\Media;
// use Spatie\MediaLibrary\HasMedia\HasMedia;
// use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Organization extends BaseModel // implements HasMedia
{
    // use HasMediaTrait;

    protected $casts = [
        'physical_address' => 'array',
        'phone_number' => 'array'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'details',
        'slug',
        'url',
        'official_email',
        'phone_number',
        'physical_address'
    ];


    public function registerMediaCollections()
    {
        $this->addMediaCollection('images');
        $this->addMediaCollection('logo')->singleFile();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('images')
            ->fit(Manipulations::FIT_CROP, 1000, 750)
            ->performOnCollections('images');

        $this->addMediaConversion('logo')
            ->fit(Manipulations::FIT_CROP, 250, 250)
            ->performOnCollections('logo');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * @param  mixed
     * @return string
     */
    public function getLogoAttribute(): ?string
    {
        $url = $this->getFirstMediaUrl('logo', 'logo');
        if ($url) {
            return url($url);
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Get the team that owns the validator.
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * Organization->Users relationship
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'organization_users');
    }

    /**
     * Organization->Accounts relationship
     *
     * @return BelongsToMany
     */
    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'organization_accounts');
    }

    /**
     * Organization->Assets relationship
     *
     * @return BelongsToMany
     */
    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(Asset::class, 'organization_assets');
    }

    /**
     * Organization->Principals relationship
     *
     * @return BelongsToMany
     */
    public function principals(): BelongsToMany
    {
        return $this->belongsToMany(Principal::class, 'organization_principals');
    }

    /**
     * Organization->Validators relationship
     *
     * @return BelongsToMany
     */
    public function validators(): BelongsToMany
    {
        return $this->belongsToMany(Validator::class, 'organization_validators');
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
     * @param Account $account
     * @return Builder
     */
    public function scopeAccountFilter($query, Account $account)
    {

        if (!empty($account)) {
            $query->whereHas('accounts', function ($query) use ($account) {
                $query->where('accounts.id', $account->id);
            });
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param Asset $asset
     * @return Builder
     */
    public function scopeAssetFilter($query, Asset $asset)
    {

        if (!empty($asset)) {
            $query->whereHas('assets', function ($query) use ($asset) {
                $query->where('assets.id', $asset->id);
            });
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param string $slug
     * @return Builder
     */
    public function scopeSlugFilter($query, $slug)
    {

        if (!empty($slug)) {
            $query->where('slug', $slug);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param User $user
     * @return Builder
     */
    public function scopePublishedFilter($query, ?User $user)
    {

        $query->where(function ($query) use ($user) {
            $query->where('published', true);

            if ($user) {
                $query->orWhereHas('users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                });
            }
        });

        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    |
    |
    */
}
