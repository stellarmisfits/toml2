<?php

namespace App\Http\Controllers\Principal;

use App\Http\Resources\Principal as PrincipalResource;
use App\Models\Account;
use App\Models\Principal;
use App\Rules\ValidateUuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PrincipalController extends Controller
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
            'linked_organization_uuid'      => ['nullable', new ValidateUuid, 'exists:organizations,uuid'],
            'unlinked_organization_uuid'    => ['nullable', new ValidateUuid, 'exists:organizations,uuid'],
        ]);

        $assets = auth()
            ->user()
            ->currentTeam()
            ->principals()
            ->linkedOrganizationUuidFilter($request->linked_organization_uuid)
            ->unlinkedOrganizationUuidFilter($request->unlinked_organization_uuid)
            ->paginate(20);

        return PrincipalResource::collection($assets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return PrincipalResource
     * @throws
     */
    public function store(Request $request): PrincipalResource
    {
        $data = $request->validate([
            'name'          =>  'required|string|max:50',
            'email'         =>  'required|email',
            'keybase'       =>  'nullable|string|max:255',
            'telegram'      =>  'nullable|string|max:255',
            'twitter'       =>  'nullable|string|max:255',
            'github'        =>  'nullable|string|max:255',
            'id_photo_hash' =>  'nullable|string|max:255',
            'verification_photo_hash' =>  'nullable|string|max:255',
        ]);

        $p = new Principal;
        $p->name = $request->name;
        $p->email = $request->email;
        $p->keybase = $request->keybase;
        $p->telegram = $request->telegram;
        $p->twitter = $request->twitter;
        $p->github = $request->github;
        $p->id_photo_hash = $request->id_photo_hash;
        $p->verification_photo_hash = $request->verification_photo_hash;
        $p->team_id = auth()->user()->currentTeam()->id;
        $p->save();

        return new PrincipalResource($p);
    }

    /**
     * Display the specified resource.
     *
     * @param  Principal $principal
     * @return PrincipalResource
     */
    public function show(Principal $principal): PrincipalResource
    {
        return new PrincipalResource($principal);
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
     * @param  Principal $principal
     * @return Response
     * @throws
     */
    public function destroy(Principal $principal)
    {
        \DB::transaction(function () use ($principal) {
            $principal->organizations()->detach();
            $principal->delete();
        });

        return response()->json(null, 204);
    }
}
