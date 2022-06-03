<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTypeResource;
use App\Models\VehicleType;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShowVehicleTypeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  VehicleType  $vehicleType
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(VehicleType $vehicleType, Request $request): JsonResponse
    {
        try {
            return response()->json([
                'status' => ResponseStatusEnum::SUCCESS,
                'code'   => Response::HTTP_OK,
                'data'   => [
                    'vehicle_type' => new VehicleTypeResource($vehicleType),
                ],
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al obtener el tipo de vehículo.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
