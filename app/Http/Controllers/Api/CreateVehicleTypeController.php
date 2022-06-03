<?php

namespace App\Http\Controllers\Api;

use App\Actions\SaveVehicleTypeAction;
use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleTypeRequest;
use App\Http\Resources\VehicleTypeResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CreateVehicleTypeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  VehicleTypeRequest  $request
     * @param  SaveVehicleTypeAction  $saveVehicleTypeAction
     * @return JsonResponse
     */
    public function __invoke(
        VehicleTypeRequest $request,
        SaveVehicleTypeAction $saveVehicleTypeAction
    ): JsonResponse {
        try {
            $data        = $request->validated();
            $vehicleType = $saveVehicleTypeAction->execute($data);
            
            return response()->json([
                'status'  => ResponseStatusEnum::SUCCESS,
                'code'    => Response::HTTP_OK,
                'data'    => [
                    'vehicle_type' => new VehicleTypeResource($vehicleType),
                ],
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al registrar el tipo de vehículo',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
