<?php

namespace Webkul\API\Http\Resources\Core;

use Illuminate\Http\Resources\Json\JsonResource;

class TechService extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'tel' => $this->tel,
            'mobile' => $this->mobile,
            'country' => $this->country,
            'city' => $this->city
        ];
    }
}