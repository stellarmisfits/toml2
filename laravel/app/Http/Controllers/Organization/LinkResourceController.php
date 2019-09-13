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
            'account_uuid'      =>  ['nullable', new ValidateUuid, 'exists:accounts,uuid', 'required_without_all:asset_uuid,principal_uuid,validator_uuid'],
            'asset_uuid'        =>  ['nullable', new ValidateUuid, 'exists:assets,uuid', 'required_without_all:account_uuid,principal_uuid,validator_uuid'],
            'principal_uuid'    =>  ['nullable', new ValidateUuid, 'exists:principals,uuid', 'required_without_all:account_uuid,asset_uuid,validator_uuid'],
            'validator_uuid'    =>  ['nullable', new ValidateUuid, 'exists:validators,uuid', 'required_without_all:account_uuid,asset_uuid,principal_uuid'],
        ]);

        $or = new OrganizationRepository();

        if($request->account_uuid){
            $account = (new Account)->whereUuid($request->account_uuid)->firstOrFail();
            $or->addAccount($organization, $account);
        }

        if($request->asset_uuid){
            $asset = (new Asset)->whereUuid($request->asset_uuid)->firstOrFail();
            $or->addAsset($organization, $asset);
        }

        if($request->principal_uuid){
            $principal = (new Principal)->whereUuid($request->principal_uuid)->firstOrFail();
            $or->addPrincipal($organization, $principal);
        }

        if($request->validator_uuid){
            $validator = (new Validator())->whereUuid($request->validator_uuid)->firstOrFail();
            $or->addValidator($organization, $validator);
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
            'account_uuid'      =>  ['nullable', new ValidateUuid, 'exists:accounts,uuid', 'required_without_all:asset_uuid,principal_uuid,validator_uuid'],
            'asset_uuid'        =>  ['nullable', new ValidateUuid, 'exists:assets,uuid', 'required_without_all:account_uuid,principal_uuid,validator_uuid'],
            'principal_uuid'    =>  ['nullable', new ValidateUuid, 'exists:principals,uuid', 'required_without_all:account_uuid,asset_uuid,validator_uuid'],
            'validator_uuid'    =>  ['nullable', new ValidateUuid, 'exists:validators,uuid', 'required_without_all:account_uuid,asset_uuid,principal_uuid'],
        ]);

        if($request->account_uuid){
            $account = (new Account)->whereUuid($request->account_uuid)->firstOrFail();
            $organization->accounts()->detach($account->id);
        }

        if($request->asset_uuid){
            $asset = (new Asset)->whereUuid($request->asset_uuid)->firstOrFail();
            $organization->assets()->detach($asset->id);
        }

        if($request->principal_uuid){
            $principal = (new Principal)->whereUuid($request->principal_uuid)->firstOrFail();
            $organization->principals()->detach($principal->id);
        }

        if($request->validator_uuid){
            $validator = (new Validator())->whereUuid($request->validator_uuid)->firstOrFail();
            $organization->validators()->detach($validator->id);
        }

        return response()->json(null, 201);
    }
}
