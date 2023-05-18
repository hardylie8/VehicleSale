<?php

namespace App\Repositories;

use App\Models\Vehicle;

class VehicleRepository extends BaseRepository
{

    /**
     * VehicleRepository constructor.
     *
     * @param Vehicle $vehicle
     */
    public function __construct(Vehicle $vehicle)
    {
        $this->model = $vehicle;
    }

}
