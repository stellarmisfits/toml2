<?php

namespace App\Http\Controllers\Organization;

use App\Models\Account;
use App\Models\Asset;
use App\Models\Organization;
use App\Models\Principal;
use App\Models\Validator;
use App\Repositories\OrganizationRepository;
use App\Rules\ValidateUuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkResourceController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Organization $organization
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Organization $organization)
    {
        $request->validate([
            'resource_uuid'     =>  ['required', new ValidateUuid],
            'resource_type'     =>  ['required', 'in:ACCOUNT,ASSET,PRINCIPAL,VALIDATOR']
        ]);

        $or = new OrganizationRepository();

        switch ($request->resource_type) {
            case 'ACCOUNT':
                $account = (new Account)->whereUuid($request->resource_uuid)->firstOrFail();
                $or->addAccount($organization, $account);
                break;
            case 'ASSET':
                $asset = (new Asset)->whereUuid($request->resource_uuid)->firstOrFail();
                $or->addAsset($organization, $asset);
                break;
            case 'PRINCIPAL':
                $principal = (new Principal)->whereUuid($request->resource_uuid)->firstOrFail();
                $or->addPrincipal($organization, $principal);
                break;
            case 'VALIDATOR':
                $validator = (new Validator())->whereUuid($request->resource_uuid)->firstOrFail();
                $or->addValidator($organization, $validator);
                break;
        }

        return response()->json(null, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Organization $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Organization $organization)
    {
        $request->validate([
            'resource_uuid'     =>  ['required', new ValidateUuid],
            'resource_type'     =>  ['required', 'in:ACCOUNT,ASSET,PRINCIPAL,VALIDATOR']
        ]);

        switch ($request->resource_type) {
            case 'ACCOUNT':
                $account = (new Account)->whereUuid($request->resource_uuid)->firstOrFail();
                $organization->accounts()->detach($account->id);
                break;
            case 'ASSET':
                $asset = (new Asset)->whereUuid($request->resource_uuid)->firstOrFail();
                $organization->assets()->detach($asset->id);
                break;
            case 'PRINCIPAL':
                $principal = (new Principal)->whereUuid($request->resource_uuid)->firstOrFail();
                $organization->principals()->detach($principal->id);
                break;
            case 'VALIDATOR':
                $validator = (new Validator())->whereUuid($request->resource_uuid)->firstOrFail();
                $organization->validators()->detach($validator->id);
                break;
        }

        return response()->json(null, 201);
    }
}
