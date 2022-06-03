<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleStayCollection;
use App\Models\VehicleStay;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ListVehicleStaysController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        try {
            $vehicleStays = VehicleStay::select();
            $q            = $request->input('q', null);
            $orderBy      = $request->input('order_by', 'id');
            $order        = $request->input('order', 'desc');
            $perPage      = (int) $request->input('per_page', 10);

            // Query filter
            if ($q) {
                $query = str_replace(' ', '%', $q);

                $vehicleStays->where('name', 'like', "%{$query}%");
            }

            $vehicleStays = $vehicleStays->orderBy($orderBy, $order)
                ->paginate($perPage);

            return new VehicleStayCollection($vehicleStays);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al listar las estancías de vehículo.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
