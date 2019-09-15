<?php

namespace App\Http\Controllers\Account;

use App\Models\Organization;
use App\Repositories\AccountRepository;
use App\Rules\PublicKey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Ramsey\Uuid\Uuid;
use ZuluCrypto\StellarSdk\Keypair;
use App\Models\Account;
use App\Http\Resources\Account as AccountResource;
use Illuminate\Validation\ValidationException;
use App\Rules\ValidateUuid;
use Illuminate\Validation\Rule;

class AccountController extends Controller
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
            'public_key'                    => ['nullable', 'string', 'size:56', new PublicKey],
            'linked_organization_uuid'      => ['nullable', new ValidateUuid, 'exists:organizations,uuid'],
            'unlinked_organization_uuid'    => ['nullable', new ValidateUuid, 'exists:organizations,uuid'],
        ]);

        $account = auth()
            ->user()
            ->currentTeam()
            ->accounts()
            // ->publicKeyFilter($request->public_key)
            ->linkedOrganizationUuidFilter($request->linked_organization_uuid)
            ->unlinkedOrganizationUuidFilter($request->unlinked_organization_uuid)
            ->paginate(20);

        return AccountResource::collection($account);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  AccountRepository  $ac
     * @return AccountResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, AccountRepository $ac): AccountResource
    {
        $data = $request->validate([
            'alias'        => 'required|string|max:15|regex:/^[a-z-].*$/|unique:accounts',
            'public_key'   => ['required', 'string', 'size:56', new PublicKey, Rule::unique('accounts', 'public_key')]
        ]);

        $a = $ac->create(auth()->user(), $data);

        return new AccountResource($a);
    }

    /**
     * Display the specified resource.
     *
     * @param  Account  $account
     * @return AccountResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Account $account): AccountResource
    {
        return new AccountResource($account);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Account  $account
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Account $account)
    {
        $this->authorize('update', $account);
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Account  $account
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function destroy(Account $account)
    {
        \DB::transaction(function () use ($account) {
            $account->organizations()->detach();
            $account->delete();
        });

        return response()->json(null, 204);
    }
}
