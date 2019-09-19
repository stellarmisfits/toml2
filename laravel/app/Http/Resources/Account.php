<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Account extends JsonResource
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
            'name'              => $this->name,
            'alias'             => $this->alias,
            'public_key'        => $this->public_key,
            'verified'          => $this->verified,
            'created_at'        => $this->created_at->toAtomString(),
            'updated_at'        => $this->updated_at->toAtomString()
        ];
    }
}
