<?php

namespace App\Actions;

use App\Models\VehicleStay;
use Exception;
use Spatie\QueueableAction\QueueableAction;

class DeleteVehicleStayAction
{
    use QueueableAction;

    use QueueableAction;

    /**
     * Execute the action.
     *
     * @param  VehicleStay  $vehicleStay
     * @return void
     * @throws Exception
     */
    public function execute(VehicleStay $vehicleStay): void
    {
        try {
            $vehicleStay->delete();
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
