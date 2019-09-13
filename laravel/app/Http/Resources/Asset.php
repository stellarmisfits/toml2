<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Asset extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request = null)
    {
        return [
            'uuid'              => $this->uuid,
            'account_uuid'      => $this->account->uuid,
            'code'              => $this->code,
            'display_decimals'  => $this->display_decimals,
            'name'              => $this->name,
            'desc'              => $this->desc,
            'conditions'        => $this->conditions,
            'image'             => $this->image,
            'published'         => $this->published,
            'created_at'        => $this->created_at->toAtomString(),
            'updated_at'        => $this->updated_at->toAtomString(),
            'redemption_instructions' => $this->redemption_instructions
        ];
    }
}
