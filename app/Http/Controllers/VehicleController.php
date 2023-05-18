<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleSaveRequest;
use App\Http\Resources\VehicleCollection;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * @var VehicleService
     */
    protected $vehicleService;

    /**
     * VehicleController Constructor
     *
     * @param VehicleService $vehicleService
     *
     */
    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new VehicleCollection($this->vehicleService->getAll()))
            ->additional(
                [
                    'success' => 'success',
                    'message' => 'Data Has been successfully retrieved',
                ]
            );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleSaveRequest $request)
    {

        $result = $this->vehicleService->saveVehicleData($request);

        return (new VehicleResource($result))
            ->additional(
                [
                    'status' => 201,
                    'message' => 'Data Has been successfully  Created',
                ]
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return (new VehicleResource($this->vehicleService->getById($vehicle->getKey())))
            ->additional(
                [
                    'success' => 'success',
                    'message' => 'Data Has been successfully retrieved',
                ]
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleSaveRequest $request, Vehicle $vehicle)
    {
        $result = $this->vehicleService->updateVehicle($request, $vehicle->getKey());

        return (new VehicleResource($result))
            ->additional(
                [
                    'status' => 201,
                    'message' => 'Data Has been successfully Updated',
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $result = $this->vehicleService->deleteById($vehicle->getKey());
        return (new VehicleResource($result))
            ->additional(
                [
                    'status' => 200,
                    'message' => 'Data Has been successfully deleted',
                ]
            );
    }
}
