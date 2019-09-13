<?php

namespace App\Http\Controllers\Organization;

use App\Http\Resources\Organization as OrganizationResource;
use App\Models\Organization;
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
     * @return OrganizationResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request): OrganizationResource
    {
        $this->authorize('create', Organization::class);

        $request->validate([
            'name'         => 'nullable|string|max:50',
            'slug'         => 'nullable|string|max:15|regex:/^[a-z-].*$/|unique:organizations',
        ]);

        $org = \DB::transaction(function () use ($request) {
            $org = new Organization;
            $org->name        = $request->name;
            $org->slug        = $request->slug ?? strtolower(str_random(15));
            $org->save();

            $user = $request->user();
            $user->organizations()->attach($org, ['id' => Uuid::uuid4()]);

            return $org;
        });


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
