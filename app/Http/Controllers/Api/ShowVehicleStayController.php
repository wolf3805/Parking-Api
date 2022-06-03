<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleStayResource;
use App\Models\VehicleStay;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShowVehicleStayController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  VehicleStay  $vehicleStay
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(VehicleStay $vehicleStay, Request $request): JsonResponse
    {
        try {
            return response()->json([
                'status' => ResponseStatusEnum::SUCCESS,
                'code'   => Response::HTTP_OK,
                'data'   => [
                    'vehicle_stay' => new VehicleStayResource($vehicleStay),
                ],
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al obtener la estancia de vehículo.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
