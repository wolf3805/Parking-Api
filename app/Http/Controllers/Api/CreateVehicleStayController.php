<?php

namespace App\Http\Controllers\Api;

use App\Actions\SaveVehicleStayAction;
use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleStayRequest;
use App\Http\Resources\VehicleStayResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CreateVehicleStayController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  VehicleStayRequest  $request
     * @param  SaveVehicleStayAction  $saveVehicleStayAction
     * @return JsonResponse
     */
    public function __invoke(
        VehicleStayRequest $request,
        SaveVehicleStayAction $saveVehicleStayAction
    ): JsonResponse {
        try {
            $data        = $request->validated();
            $vehicleStay = $saveVehicleStayAction->execute($data);
            
            return response()->json([
                'status'  => ResponseStatusEnum::SUCCESS,
                'code'    => Response::HTTP_OK,
                'data'    => [
                    'vehicle_stay' => new VehicleStayResource($vehicleStay),
                ],
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al registrar la estancia de vehículo',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
