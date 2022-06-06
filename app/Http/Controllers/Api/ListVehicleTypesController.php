<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTypeCollection;
use App\Models\VehicleType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ListVehicleTypesController extends Controller
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
            $vehicleTypes = VehicleType::select();
            $q            = $request->input('q', null);
            $orderBy      = $request->input('order_by', 'id');
            $order        = $request->input('order', 'desc');
            $perPage      = (int) $request->input('per_page', 10);

            // Query filter
            if ($q) {
                $query = str_replace(' ', '%', $q);

                $vehicleTypes->where('title', 'like', "%{$query}%");
            }

            $vehicleTypes = $vehicleTypes->orderBy($orderBy, $order)
                ->paginate($perPage);

            return new VehicleTypeCollection($vehicleTypes);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al listar los tipos de vehículos.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
