<?php

use App\Http\Controllers\Api\CreateVehicleController;
use App\Http\Controllers\Api\CreateVehicleStayController;
use App\Http\Controllers\Api\CreateVehicleTypeController;
use App\Http\Controllers\Api\DeleteVehicleController;
use App\Http\Controllers\Api\DeleteVehicleStayController;
use App\Http\Controllers\Api\DeleteVehicleTypeController;
use App\Http\Controllers\Api\ListVehiclesController;
use App\Http\Controllers\Api\ListVehicleStaysController;
use App\Http\Controllers\Api\ListVehicleTypesController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\ShowVehicleController;
use App\Http\Controllers\Api\ShowVehicleStayController;
use App\Http\Controllers\Api\ShowVehicleTypeController;
use App\Http\Controllers\Api\UpdateVehicleController;
use App\Http\Controllers\Api\UpdateVehicleStayController;
use App\Http\Controllers\Api\UpdateVehicleTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')
    ->group(function () {
    
    /**
     * Auth
     */
    Route::post('login', LoginController::class);
    Route::post('logout', LogoutController::class);

    /**
     * Vehicle types
     */
    Route::prefix('vehicle-types')
        ->group(function () {
        Route::get('/', ListVehicleTypesController::class);
        Route::post('/', CreateVehicleTypeController::class);
        Route::get('/{vehicle_type}', ShowVehicleTypeController::class);
        Route::put('/{vehicle_type}', UpdateVehicleTypeController::class);
        Route::delete('/{vehicle_type}', DeleteVehicleTypeController::class);
    });

    /**
     * Vehicles
     */
    Route::prefix('vehicles')
        ->group(function () {
        Route::get('/', ListVehiclesController::class);
        Route::post('/', CreateVehicleController::class);
        Route::get('/{vehicle}', ShowVehicleController::class);
        Route::put('/{vehicle}', UpdateVehicleController::class);
        Route::delete('/{vehicle}', DeleteVehicleController::class);
    });

    /**
     * Vehicle stays
     */
    Route::prefix('vehicle-stays')
        ->group(function () {
        Route::get('/', ListVehicleStaysController::class);
        Route::post('/', CreateVehicleStayController::class);
        Route::get('/{vehicle_stay}', ShowVehicleStayController::class);
        Route::put('/{vehicle_stay}', UpdateVehicleStayController::class);
        Route::delete('/{vehicle_stay}', DeleteVehicleStayController::class);
    });

});
