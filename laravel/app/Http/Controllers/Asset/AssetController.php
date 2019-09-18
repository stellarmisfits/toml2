<?php

namespace App\Http\Controllers\Asset;

use App\Models\Asset;
use App\Repositories\AssetRepository;
use App\Rules\ValidateUuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Asset as AssetResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $request->validate([
            'account_uuid'                  => ['nullable', new ValidateUuid, 'exists:accounts,uuid'],
            'linked_organization_uuid'      => ['nullable', new ValidateUuid, 'exists:organizations,uuid'],
            'unlinked_organization_uuid'    => ['nullable', new ValidateUuid, 'exists:organizations,uuid'],
        ]);

        $assets = auth()
            ->user()
            ->currentTeam()
            ->assets()
            ->accountUuidFilter($request->account_uuid)
            ->linkedOrganizationUuidFilter($request->linked_organization_uuid)
            ->unlinkedOrganizationUuidFilter($request->unlinked_organization_uuid)
            ->paginate(20);

        return AssetResource::collection($assets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @param  AssetRepository  $ar
     * @return AssetResource
     */
    public function store(Request $request, AssetRepository $ar)
    {
        $data = $request->validate([
            'name'                  =>  ['required', 'string', 'max:20'],
            'code'                  =>  ['required', 'string', 'max:12'],
            'desc'                  =>  ['required', 'string', 'max:255'],
            'account_uuid'          =>  ['required', new ValidateUuid, 'exists:accounts,uuid'],
        ]);

        $asset = $ar->create(auth()->user(),  $data);

        return new AssetResource($asset);
    }

    /**
     * Display the specified resource.
     *
     * @param  Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        return new AssetResource($asset);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Asset  $asset
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function destroy(Asset $asset)
    {
        \DB::transaction(function () use ($asset) {
            $asset->organizations()->detach();
            $asset->delete();
        });

        return response()->json(null, 204);
    }
}
