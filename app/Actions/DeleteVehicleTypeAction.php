<?php

namespace App\Actions;

use App\Models\VehicleType;
use Exception;
use Spatie\QueueableAction\QueueableAction;

class DeleteVehicleTypeAction
{
    use QueueableAction;

    /**
     * Execute the action.
     *
     * @param  VehicleType  $vehicleType
     * @return void
     * @throws Exception
     */
    public function execute(VehicleType $vehicleType): void
    {
        try {
            $vehicleType->delete();
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
