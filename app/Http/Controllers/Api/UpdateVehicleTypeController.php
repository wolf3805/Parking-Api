<?php

namespace App\Http\Controllers\Api;

use App\Actions\SaveVehicleTypeAction;
use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleTypeRequest;
use App\Models\VehicleType;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UpdateVehicleTypeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  VehicleType  $vehicleType
     * @param  VehicleTypeRequest  $request
     * @param  SaveVehicleTypeAction  $saveVehicleTypeAction
     * @return JsonResponse
     */
    public function __invoke(
        VehicleType $vehicleType,
        VehicleTypeRequest $request,
        SaveVehicleTypeAction $saveVehicleTypeAction
    ): JsonResponse {
        try {
            $data        = $request->validated();
            $vehicleType = $saveVehicleTypeAction->execute(
                $data,
                $vehicleType
            );

            return response()->json([
                'status' => ResponseStatusEnum::SUCCESS,
                'code'   => Response::HTTP_OK,
                'data'   => [
                    'vehicle_type' => $vehicleType,
                ], 
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al actualizar el tipo de vehículo.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
