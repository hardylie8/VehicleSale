<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarSaveRequest;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Services\CarService;

class CarController extends Controller
{
    /**
     * @var CarService
     */
    protected $carService;

    /**
     * CarController Constructor
     *
     * @param CarService $carService
     *
     */
    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new CarCollection($this->carService->getAll()))
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
    public function store(CarSaveRequest $request)
    {

        $result = $this->carService->saveCarData($request);

        return (new CarResource($result))
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
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return (new CarResource($this->carService->getById($car->getKey())))
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
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(CarSaveRequest $request, Car $car)
    {
        $result = $this->carService->updateCar($request, $car->getKey());

        return (new CarResource($result))
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
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $result = $this->carService->deleteById($car->getKey());
        return (new CarResource($result))
            ->additional(
                [
                    'status' => 200,
                    'message' => 'Data Has been successfully deleted',
                ]
            );
    }
}
