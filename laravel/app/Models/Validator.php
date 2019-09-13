<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Validator extends BaseModel
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
     * Get the team that owns the validator.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * Get the team that owns the validator.
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    /**
     * Get all of the organizations that the validator belongs to.
     */
    public function organizations()
    {
        return $this->belongsToMany(
            Organization::class,
            'organization_validators',
            'validator_id',
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
     * @param string $organization_uuid
     * @return Builder
     */
    public function scopeOrganizationUuidFilter(Builder $query, string $organization_uuid = null)
    {
        if (!empty($account)) {
            $query->whereHas('organizations', function ($query) use ($organization_uuid) {
                $query->where('organizations.uuid', $organization_uuid);
            });
        }

        return $query;
    }
}
