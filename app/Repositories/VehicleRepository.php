<?php

namespace App\Repositories;

use App\Models\Vehicle;

class VehicleRepository
{
    /**
     * @var Vehicle
     */
    protected $vehicle;

    /**
     * VehicleRepository constructor.
     *
     * @param Vehicle $vehicle
     */
    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Get all vehicles.
     *
     * @return Vehicle $vehicle
     */
    public function getAll()
    {
        return $this->vehicle->with(['car', 'motorcycle'])
            ->jsonPaginate();
    }

    /**
     * Get vehicle by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->vehicle
            ->with(['car', 'motorcycle'])->findOrFail($id);
    }

    /**
     * Save Vehicle
     *
     * @param $data
     * @return Vehicle
     */
    public function save($data)
    {
        $vehicle = $this->vehicle;
        $vehicle->fill($data->only($vehicle->offsetGet('fillable')))
            ->save();

        return $vehicle->fresh();
    }

    /**
     * Update Vehicle
     *
     * @param $data
     * @return Vehicle
     */
    public function update($data, $id)
    {
        $vehicle = $this->getById($id);
        $vehicle->fill($data->only($vehicle->offsetGet('fillable')));
        if ($vehicle->isDirty()) {
            $vehicle->save();
        }
        return $vehicle;
    }

    /**
     * Update Vehicle
     *
     * @param $data
     * @return Vehicle
     */
    public function delete($id)
    {
        $vehicle = $this->getById($id);
        $vehicle->delete();
        return $vehicle;
    }

}
