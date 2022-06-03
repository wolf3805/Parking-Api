<?php

namespace App\Http\Controllers\Api;

use App\Actions\DeleteVehicleTypeAction;
use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteVehicleTypeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  VehicleType  $vehicleType
     * @param  Request  $request
     * @param  DeleteVehicleTypeAction $deleteVehicleTypeAction
     * @return JsonResponse
     */
    public function __invoke(
        VehicleType $vehicleType,
        Request $request,
        DeleteVehicleTypeAction $deleteVehicleTypeAction
    ): JsonResponse {
        try {
            $deleteVehicleTypeAction->execute($vehicleType);

            return response()->json([
                'status' => ResponseStatusEnum::SUCCESS,
                'code'   => Response::HTTP_OK,
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al eliminar el tipo de vehículo.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
