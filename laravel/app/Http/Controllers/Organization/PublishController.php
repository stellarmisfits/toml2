<?php

namespace App\Http\Controllers\Organization;

use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Organization as OrganizationResource;

class PublishController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Organization $organization
     * @param  OrganizationRepository  $or
     * @return OrganizationResource
     */
    public function store(Request $request, Organization $organization, OrganizationRepository $or): OrganizationResource
    {
        $organization->published = true;
        $organization->save();

        return new OrganizationResource($organization);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Organization  $organization
     * @return OrganizationResource
     * @throws
     */
    public function destroy(Organization $organization)
    {
        $organization->published = false;
        $organization->save();

        return new OrganizationResource($organization);
    }
}
