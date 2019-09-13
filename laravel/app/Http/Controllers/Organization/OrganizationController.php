<?php

namespace App\Http\Controllers\Organization;

use App\Http\Resources\Organization as OrganizationResource;
use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Ramsey\Uuid\Uuid;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $request->validate([
            'slug'       => 'nullable|string|max:15|regex:/^[a-z-].*$/|exists:organizations,slug',
        ]);

        $org = auth()
            ->user()
            ->currentTeam()
            ->organizations()
            // ->slugFilter($request->slug)
            ->paginate(20);

        return OrganizationResource::collection($org);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  OrganizationRepository  $or
     * @return OrganizationResource
     */
    public function store(Request $request, OrganizationRepository $or): OrganizationResource
    {
        $data = $request->validate([
            'name'         => 'required|string|max:50',
            'alias'        => 'required|string|max:15|regex:/^[a-z-].*$/|unique:organizations',
        ]);

        $org = $or->create(auth()->user(),  $data);

        return new OrganizationResource($org);
    }

    /**
     * Display the specified resource.
     *
     * @param  Organization  $organization
     * @return OrganizationResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Organization $organization): OrganizationResource
    {
        $this->authorize('view', $organization);
        return new OrganizationResource($organization);
    }
}
