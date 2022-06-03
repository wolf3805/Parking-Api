<?php

namespace App\Http\Resources;

use App\Http\Traits\HasCustomResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    use HasCustomResponse;

    /**
     * Transform the resource collection into an array.
     *
     * @param Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->formatResponse(
            'users',
            UserResource::collection($this->collection)
        );
    }
}
