<?php

namespace App\Http\Controllers\Api;

use App\Actions\DeleteVehicleAction;
use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteVehicleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Vehicle  $vehicle
     * @param  Request  $request
     * @param  DeleteVehicleAction $deleteVehicleAction
     * @return JsonResponse
     */
    public function __invoke(
        Vehicle $vehicle,
        Request $request,
        DeleteVehicleAction $deleteVehicleAction
    ): JsonResponse {
        try {
            $deleteVehicleAction->execute($vehicle);

            return response()->json([
                'status' => ResponseStatusEnum::SUCCESS,
                'code'   => Response::HTTP_OK,
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al eliminar el vehículo.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
