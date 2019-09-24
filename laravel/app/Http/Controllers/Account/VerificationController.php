<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account as AccountResource;
use App\Models\Account;
use App\Repositories\AccountRepository;
use App\Services\StellarAccountService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use ZuluCrypto\StellarSdk\Server;

class VerificationController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Account $account
     * @param AccountRepository $ar
     * @param StellarAccountService $sa
     * @return AccountResource
     * @throws \Throwable
     */
    public function store(Account $account, AccountRepository $ar, StellarAccountService $sa)
    {
        throw_unless($account->organization, ValidationException::withMessages([
            'account_uuid' => 'This account is not associated with an organization.'
        ]));

        $sAccount = $sa->getAccount($account->public_key);
        $ar->verify($account, $sAccount);

        return new AccountResource($account);
    }

}
