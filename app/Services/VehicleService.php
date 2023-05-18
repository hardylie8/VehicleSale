<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use Illuminate\Support\Facades\DB;

class VehicleService
{
    /**
     * @var $vehicleRepository
     */
    protected $vehicleRepository;

    /**
     * VehicleService constructor.
     *
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * Delete vehicle by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        return $this->vehicleRepository->delete($id);
    }

    /**
     * Get all vehicle.
     *
     * @return String
     */
    public function getAll()
    {
        $vehicle = $this->vehicleRepository->getAll();
        return !$vehicle->isEmpty()
        ? $vehicle->toQuery()->with(['car', 'motorcycle'])->jsonPaginate()
        : $vehicle;
    }

    /**
     * Get vehicle by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->vehicleRepository->getById($id);
    }

    /**
     * Update vehicle data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateVehicle($data, $id)
    {
        return $this->vehicleRepository->update($data, $id);
    }

    /**
     * Validate vehicle data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveVehicleData($data)
    {
        return $this->vehicleRepository->save($data);
    }

}
