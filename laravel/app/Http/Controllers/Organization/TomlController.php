<?php

namespace App\Http\Controllers\Organization;

use App\Models\Organization;
use App\Services\TomlService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TomlController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        $ts = new TomlService($organization);
        $toml = $ts->generateToml();

        return response()->json([
            'uuid' => $organization->uuid,
            'toml' => $toml->getTomlString()
        ]);
    }
}
