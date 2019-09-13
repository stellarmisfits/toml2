<?php

namespace App\Http\Controllers\Validator;

use App\Http\Resources\Validator as ValidatorResource;
use App\Models\Account;
use App\Models\Validator;
use App\Rules\ValidateUuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ValidatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $request->validate([
            'organization_uuid'     =>  ['nullable', new ValidateUuid, 'exists:organizations,uuid'],
        ]);

        $assets = auth()
            ->user()
            ->currentTeam()
            ->validators()
            ->organizationUuidFilter($request->organization_uuid)
            ->paginate(20);

        return ValidatorResource::collection($assets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return ValidatorResource
     * @throws
     */
    public function store(Request $request): ValidatorResource
    {
        $data = $request->validate([
            'account_uuid'  =>  ['required', new ValidateUuid, 'exists:accounts,uuid'],
            'name'          =>  'required|string|max:50',
            'alias'         =>  'required|string|max:15|regex:/^[a-z-].*$/|unique:validators',
            'host'          =>  'nullable|string|max:255',
            'history'       =>  'nullable|string|max:255',
        ]);

        $account = (new Account)->whereUuid($request->account_uuid)->firstOrFail();

        $v = new Validator;
        $v->name = $request->name;
        $v->alias = $request->alias;
        $v->account_id = $account->id;
        $v->team_id = auth()->user()->currentTeam()->id;
        $v->save();

        return new ValidatorResource($v);
    }

    /**
     * Display the specified resource.
     *
     * @param  Validator $validator
     * @return ValidatorResource
     */
    public function show(Validator $validator): ValidatorResource
    {
        return new ValidatorResource($validator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Validator $validator
     * @return Response
     * @throws
     */
    public function destroy(Validator $validator)
    {
        \DB::transaction(function () use ($validator) {
            $validator->organizations()->detach();
            $validator->delete();
        });

        return response()->json(null, 204);
    }
}
