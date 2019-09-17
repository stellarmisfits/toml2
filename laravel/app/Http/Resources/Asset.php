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
            'uuid'                      => $this->uuid,
            'account_uuid'              => optional($this->account)->uuid,
            'account_public_key'        => optional($this->account)->public_key,
            // 'published'              => $this->published, // true if linked organization is published

            'name'                      => $this->name,
            'code'                      => $this->code,
            'desc'                      => $this->desc,
            'code_template'             => $this->code_template,
            // 'issuer'                 => $this->issuer, // obtain through account_uuid
            'status'                    => $this->status,
            'display_decimals'          => $this->display_decimals,
            'conditions'                => $this->conditions,
            'image'                     => $this->image,
            'fixed_number'              => $this->fixed_number,
            'max_number'                => $this->max_number,
            'is_unlimited'              => $this->is_unlimited,
            'is_asset_anchored'         => $this->is_asset_anchored,
            'anchor_asset_type'         => $this->anchor_asset_type,
            'anchor_asset'              => $this->anchor_asset,
            'redemption_instructions'   => $this->redemption_instructions,
            'collateral_address_messages'   => $this->collateral_address_messages,
            'collateral_address_signatures' => $this->collateral_address_signatures,
            'regulated'                 => $this->regulated,
            'approval_server'           => $this->approval_server,
            'approval_criteria'         => $this->approval_criteria,

            'created_at'                => $this->created_at->toAtomString(),
            'updated_at'                => $this->updated_at->toAtomString(),
        ];
    }
}
