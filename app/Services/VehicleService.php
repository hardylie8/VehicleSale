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
        $result = $this->vehicleRepository->delete($id);
        return $result;
    }

    /**
     * Get all vehicle.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->vehicleRepository->getAll();
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
        $result = $this->vehicleRepository->update($data, $id);
        return $result;

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
        $result = $this->vehicleRepository->save($data);
        return $result;
    }

}
