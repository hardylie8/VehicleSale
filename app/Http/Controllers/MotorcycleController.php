<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotorcycleSaveRequest;
use App\Http\Resources\MotorcycleCollection;
use App\Http\Resources\MotorcycleResource;
use App\Models\Motorcycle;
use App\Services\MotorcycleService;
use Illuminate\Http\Request;

class MotorcycleController extends Controller
{
    /**
     * @var MotorcycleService
     */
    protected $motorcycleService;

    /**
     * MotorcycleController Constructor
     *
     * @param MotorcycleService $motorcycleService
     *
     */
    public function __construct(MotorcycleService $motorcycleService)
    {
        $this->motorcycleService = $motorcycleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new MotorcycleCollection($this->motorcycleService->getAll()))
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
    public function store(MotorcycleSaveRequest $request)
    {

        $result = $this->motorcycleService->saveMotorcycleData($request);

        return (new MotorcycleResource($result))
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
     * @param  \App\Models\Motorcycle  $motorcycle
     * @return \Illuminate\Http\Response
     */
    public function show(Motorcycle $motorcycle)
    {
        return (new MotorcycleResource($this->motorcycleService->getById($motorcycle->getKey())))
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
     * @param  \App\Models\Motorcycle  $motorcycle
     * @return \Illuminate\Http\Response
     */
    public function edit(Motorcycle $motorcycle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motorcycle  $motorcycle
     * @return \Illuminate\Http\Response
     */
    public function update(MotorcycleSaveRequest $request, Motorcycle $motorcycle)
    {
        $result = $this->motorcycleService->updateMotorcycle($request, $motorcycle->getKey());

        return (new MotorcycleResource($result))
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
     * @param  \App\Models\Motorcycle  $motorcycle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motorcycle $motorcycle)
    {
        $result = $this->motorcycleService->deleteById($motorcycle->getKey());
        return (new MotorcycleResource($result))
            ->additional(
                [
                    'status' => 200,
                    'message' => 'Data Has been successfully deleted',
                ]
            );
    }
}
