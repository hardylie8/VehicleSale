<?php

namespace App\Repositories;

use App\Models\Motorcycle;

class MotorcycleRepository extends BaseRepository
{

    /**
     * MotorcycleRepository constructor.
     *
     * @param Motorcycle $motorcycle
     */
    public function __construct(Motorcycle $motorcycle)
    {
        $this->model = $motorcycle;
    }

}
