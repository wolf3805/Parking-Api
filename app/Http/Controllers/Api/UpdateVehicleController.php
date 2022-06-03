<?php

namespace App\Http\Controllers\Api;

use App\Actions\SaveVehicleAction;
use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UpdateVehicleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Vehicle  $vehicle
     * @param  VehicleRequest  $request
     * @param  SaveVehicleAction  $saveVehicleAction
     * @return JsonResponse
     */
    public function __invoke(
        Vehicle $vehicle,
        VehicleRequest $request,
        SaveVehicleAction $saveVehicleAction
    ): JsonResponse {
        try {
            $data        = $request->validated();
            $vehicle = $saveVehicleAction->execute(
                $data,
                $vehicle
            );

            return response()->json([
                'status' => ResponseStatusEnum::SUCCESS,
                'code'   => Response::HTTP_OK,
                'data'   => [
                    'vehicle' => $vehicle,
                ], 
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al actualizar el vehículo.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
