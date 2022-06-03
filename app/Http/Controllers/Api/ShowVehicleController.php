<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShowVehicleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Vehicle  $vehicle
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(Vehicle $vehicle, Request $request): JsonResponse
    {
        try {
            return response()->json([
                'status' => ResponseStatusEnum::SUCCESS,
                'code'   => Response::HTTP_OK,
                'data'   => [
                    'vehicle' => new VehicleResource($vehicle),
                ],
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al obtener el vehículo.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
