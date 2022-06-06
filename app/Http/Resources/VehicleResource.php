<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'id'              => $this->id,
            'vehicle_type_id' => $this->vehicle_type_id,
            'plate_number'    => $this->plate_number,
            'plate_number'    => $this->plate_number,
            'created_at'      => $this->created_at ? $this->created_at->format('Y-m-d\TH:i') : null,
            'updated_at'      => $this->updated_at ? $this->updated_at->format('Y-m-d\TH:i') : null,
        ];
    }
}
