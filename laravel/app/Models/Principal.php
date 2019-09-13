<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Principal extends BaseModel
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
     * Get the team that owns the principal.
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * Get all of the organizations that the principal belongs to.
     */
    public function organizations()
    {
        return $this->belongsToMany(
            Organization::class,
            'organization_principals',
            'principal_id',
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

    //
}
