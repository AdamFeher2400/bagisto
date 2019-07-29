<?php

namespace Webkul\API\Http\Resources\Core;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
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
            'fax' => $this->fax,
            'domain' => $this->domain,
            'email' => $this->email
        ];
    }
}