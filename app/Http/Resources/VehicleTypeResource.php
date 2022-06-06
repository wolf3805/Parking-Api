<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleTypeResource extends JsonResource
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
            'id'          => $this->id,
            'key'         => $this->key,
            'title'       => $this->title,
            'description' => $this->description,
            'rate'        => $this->rate,
            'created_at'  => $this->created_at ? $this->created_at->format('Y-m-d\TH:i') : null,
            'updated_at'  => $this->updated_at ? $this->updated_at->format('Y-m-d\TH:i') : null,
        ];
    }
}
