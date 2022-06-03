<?php

namespace App\Actions;

use App\Models\VehicleType;
use Exception;
use Spatie\QueueableAction\QueueableAction;

class SaveVehicleTypeAction
{
    use QueueableAction;

    /**
     * Execute the action.
     *
     * @param  array  $data
     * @param  VehicleType|null  $vehicleType
     * @return VehicleType
     * @throws Throwable
     */
    public function execute(array $data, VehicleType $vehicleType = null): VehicleType
    {
        try {
            if ($vehicleType) {
                $vehicleType = tap($vehicleType)->update($data);
            } else {
                $vehicleType = VehicleType::create($data);
            }

            return $vehicleType;
        } catch(Exception $exception) {
            throw $exception;
        }
    }
}
