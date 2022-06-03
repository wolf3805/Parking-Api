<?php

namespace App\Actions;

use App\Models\Vehicle;
use Exception;
use Spatie\QueueableAction\QueueableAction;

class DeleteVehicleAction
{
    use QueueableAction;

    use QueueableAction;

    /**
     * Execute the action.
     *
     * @param  Vehicle  $vehicle
     * @return void
     * @throws Exception
     */
    public function execute(Vehicle $vehicle): void
    {
        try {
            $vehicle->delete();
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
