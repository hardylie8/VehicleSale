<?php

namespace App\Repositories;

use App\Models\Car;

class CarRepository extends BaseRepository
{

    /**
     * CarRepository constructor.
     *
     * @param Car $car
     */
    public function __construct(Car $car)
    {
        $this->model = $car;
    }

}
