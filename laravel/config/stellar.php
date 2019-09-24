<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server
    |--------------------------------------------------------------------------
    |
    |
    */

    'horizon' => [
        'type' => env('HORIZON_TYPE', 'testnet'),
        'host' => env('HORIZON_HOST', 'https://horizon-testnet.stellar.org')
    ],

    /*
    |--------------------------------------------------------------------------
    | Redeemable Assets
    |--------------------------------------------------------------------------
    | This asset is redeemable for application credit
    |
    */

    'asset' => [
        'code' => env('ASSET_CODE'),
        'issuer' => env('ASSET_ISSUER')
    ],

    /*
    |--------------------------------------------------------------------------
    | Test Accounts
    |--------------------------------------------------------------------------
    |
    |
    */

    'accounts' => [
        'ASTRIFY' => [
            'public' => env('ASTRIFY_PUBLIC_KEY'),
            'secret' => env('ASTRIFY_SECRET_KEY')
        ]
    ],
];
