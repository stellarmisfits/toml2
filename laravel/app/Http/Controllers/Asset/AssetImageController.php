<?php

namespace App\Http\Controllers\Asset;

use App\Http\Resources\Asset as AssetResource;
use App\Models\Asset;
use App\Rules\ValidateUuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class AssetImageController extends Controller
{
    /**
     * Store the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Asset $asset
     * @return AssetResource
     * @throws
     */
    public function store(Request $request, Asset $asset)
    {
        $data = $request->validate([
            'filename'      => ['required', 'string', 'max:255'],
            'content_type'  => ['required', 'string', 'max:255'],
            'uuid'          => ['required', new ValidateUuid],
        ]);

        $base64 = base64_encode(\Storage::get('tmp/' .$data['uuid']));

        $asset->addMediaFromBase64($base64, ['image/png', 'image/jpeg'])
            ->usingFileName($data['filename'])
            ->toMediaCollection('image');

        return new AssetResource($asset);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Asset $asset
     * @return Response
     */
    public function destroy(Asset $asset)
    {
        $asset->clearMediaCollection('image');
        return response()->json([], 204);
    }
}
