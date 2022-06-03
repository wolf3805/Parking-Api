<?php

namespace App\Http\Traits;

use App\Enums\ResponseStatusEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceResponse;
use Symfony\Component\HttpFoundation\Response;

trait HasCustomResponse
{
    /**
     * Additional data for payload.
     *
     * @param  Request  $request
     * @return array
     */
    public function with($request): array
    {
        return [
            'status' => ResponseStatusEnum::SUCCESS,
            'code'   => Response::HTTP_OK,
        ];
    }

    /**
     * Create an HTTP response that represents the object.
     * Delete default pagination keys
     * 
     * @param  Request $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return (new ResourceResponse($this))->toResponse($request);
    }

    /**
     * Format api response
     * 
     * @param  string  $resourceCollectionName
     * @param  AnonymousResourceCollection  $resourceCollection
     * @return array
     */
    public function formatResponse(
        string  $resourceCollectionName,
        AnonymousResourceCollection $resourceCollection
    ): array {
        return [
            'data' => [
                $resourceCollectionName => $resourceCollection,
                'meta' => [
                    'total'        => $this->total(),
                    'count'        => $this->count(),
                    'per_page'     => $this->perPage(),
                    'current_page' => $this->currentPage(),
                    'total_pages'  => $this->lastPage(),
                    'first_item'   => $this->firstItem(),
                    'last_item'    => $this->lastItem(),
                ],
                'links' => [
                    'first'  => $this->url(1),
                    'prev'   => $this->previousPageUrl(),
                    'next'   => $this->nextPageUrl(),
                    'last'   => $this->url($this->lastPage()),
                ],
            ],
        ];
    }
}