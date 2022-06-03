<?php

namespace App\Http\Controllers\Api;

use App\Actions\DeleteVehicleStayAction;
use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\VehicleStay;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteVehicleStayController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  VehicleStay  $vehicleStay
     * @param  Request  $request
     * @param  DeleteVehicleStayAction $deleteVehicleStayAction
     * @return JsonResponse
     */
    public function __invoke(
        VehicleStay $vehicleStay,
        Request $request,
        DeleteVehicleStayAction $deleteVehicleStayAction
    ): JsonResponse {
        try {
            $deleteVehicleStayAction->execute($vehicleStay);

            return response()->json([
                'status' => ResponseStatusEnum::SUCCESS,
                'code'   => Response::HTTP_OK,
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al eliminar la estancia de vehículo.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
