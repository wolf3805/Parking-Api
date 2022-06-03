<?php

namespace App\Http\Controllers\Api;

use App\Actions\SaveVehicleStayAction;
use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleStayRequest;
use App\Models\VehicleStay;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UpdateVehicleStayController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  VehicleStay  $vehicleStay
     * @param  VehicleStayRequest  $request
     * @param  SaveVehicleStayAction  $saveVehicleStayAction
     * @return JsonResponse
     */
    public function __invoke(
        VehicleStay $vehicleStay,
        VehicleStayRequest $request,
        SaveVehicleStayAction $saveVehicleStayAction
    ): JsonResponse {
        try {
            $data        = $request->validated();
            $vehicleStay = $saveVehicleStayAction->execute(
                $data,
                $vehicleStay
            );

            return response()->json([
                'status' => ResponseStatusEnum::SUCCESS,
                'code'   => Response::HTTP_OK,
                'data'   => [
                    'vehicle_stay' => $vehicleStay,
                ], 
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al actualizar la estancia de vehículo.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
