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
     * @return HasMany
     */
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    /**
     * Organization->Principals relationship
     *
     * @return HasMany
     */
    public function principals(): HasMany
    {
        return $this->hasMany(Principal::class);
    }

    /**
     * Organization->Assets relationship
     *
     * @return HasManyThrough
     */
    public function assets(): HasManyThrough
    {
        return $this->hasManyThrough(Asset::class, Account::class);
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
    public function scopeUserFilter($query, User $user)
    {

        if (!empty($user)) {
            $query->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
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
