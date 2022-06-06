<?php

namespace App\Actions;

use App\Models\VehicleStay;
use Exception;
use Spatie\QueueableAction\QueueableAction;

class SaveVehicleStayAction
{
    use QueueableAction;

    /**
     * Execute the action.
     *
     * @param  array  $data
     * @param  VehicleStay|null  $vehicleStay
     * @return VehicleStay
     * @throws Throwable
     */
    public function execute(array $data, VehicleStay $vehicleStay = null): VehicleStay
    {
        try {
            if ($vehicleStay) {
                $vehicleStay = tap($vehicleStay)->update($data);
            } else {
                $data['check_in'] = now();
                $vehicleStay = VehicleStay::create($data);
            }

            return $vehicleStay;
        } catch(Exception $exception) {
            throw $exception;
        }
    }
}
