<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleCollection;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ListVehiclesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        try {
            $vehicles = Vehicle::select();
            $q        = $request->input('q', null);
            $orderBy  = $request->input('order_by', 'id');
            $order    = $request->input('order', 'desc');
            $perPage  = (int) $request->input('per_page', 10);

            // Query filter
            if ($q) {
                $query = str_replace(' ', '%', $q);

                $vehicles->where('name', 'like', "%{$query}%");
            }

            $vehicles = $vehicles->orderBy($orderBy, $order)
                ->paginate($perPage);

            return new VehicleCollection($vehicles);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al listar los vehículos.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
