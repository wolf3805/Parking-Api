<?php

namespace App\Actions;

use App\Models\Vehicle;
use Exception;
use Spatie\QueueableAction\QueueableAction;

class SaveVehicleAction
{
    use QueueableAction;

    /**
     * Execute the action.
     *
     * @param  array  $data
     * @param  Vehicle|null  $vehicle
     * @return Vehicle
     * @throws Throwable
     */
    public function execute(array $data, Vehicle $vehicle = null): Vehicle
    {
        try {
            if ($vehicle) {
                $vehicle = tap($vehicle)->update($data);
            } else {
                $vehicle = Vehicle::create($data);
            }

            return $vehicle;
        } catch(Exception $exception) {
            throw $exception;
        }
    }
}
