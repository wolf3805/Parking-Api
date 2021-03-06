<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleStayResource extends JsonResource
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
            'id'         => $this->id,
            'user_id'    => $this->user_id,
            'vehicle_id' => $this->vehicle_id,
            'check_in'   => $this->check_in,
            'check_out'  => $this->check_out,
            'created_at'  => $this->created_at ? $this->created_at->format('Y-m-d\TH:i') : null,
            'updated_at'  => $this->updated_at ? $this->updated_at->format('Y-m-d\TH:i') : null,
        ];
    }
}
