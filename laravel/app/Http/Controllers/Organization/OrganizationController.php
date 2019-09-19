<?php

namespace App\Http\Controllers\Organization;

use App\Http\Resources\Organization as OrganizationResource;
use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use App\Rules\ValidateUuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;
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
            'linked_account_uuid'   =>  ['nullable', new ValidateUuid, 'exists:accounts,uuid'],
            'unlinked_account_uuid' =>  ['nullable', new ValidateUuid, 'exists:accounts,uuid'],
            'linked_asset_uuid'     =>  ['nullable', new ValidateUuid, 'exists:assets,uuid'],
            'unlinked_asset_uuid'   =>  ['nullable', new ValidateUuid, 'exists:assets,uuid'],
        ]);

        $org = auth()
            ->user()
            ->currentTeam()
            ->organizations()
            ->accountUuidFilter($request->linked_account_uuid)
            ->accountMissingUuidFilter($request->unlinked_account_uuid)
            ->assetUuidFilter($request->linked_asset_uuid)
            ->assetMissingUuidFilter($request->asset_missing)
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

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Organization $organization
     * @return  OrganizationResource
     */
    public function update(Request $request, Organization $organization): OrganizationResource
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:20'],
            'alias'      => ['required', 'string', 'max:15', 'regex:/^[a-z-].*$/', Rule::unique('organizations', 'alias')->ignore($organization->id)],
        ]);

        $organization->update($data);

        return new OrganizationResource($organization);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Organization  $organization
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function destroy(Organization $organization)
    {
        \DB::transaction(function () use ($organization) {
            $organization->accounts()->detach();
            $organization->assets()->detach();
            $organization->principals()->detach();
            $organization->validators()->detach();
            $organization->delete();
        });

        return response()->json(null, 204);
    }
}
