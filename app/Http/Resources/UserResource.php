<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'last_name'    => $this->last_name,
            'family_name'  => $this->family_name,
            'full_name'    => $this->full_name,
            'email'        => $this->email,
            'birthdate'    => $this->birthdate,
            'address'      => $this->address,
            'phone_number' => $this->phone_number,
            'avatar'       => $this->avatar,
        ];
    }
}
