<?php

namespace App\Services;

use App\Models\Motorcycle;
use App\Repositories\MotorcycleRepository;
use Illuminate\Support\Facades\DB;

class MotorcycleService
{
    /**
     * @var $motorcycleRepository
     */
    protected $motorcycleRepository;

    /**
     * MotorcycleService constructor.
     *
     * @param MotorcycleRepository $motorcycleRepository
     */
    public function __construct(MotorcycleRepository $motorcycleRepository)
    {
        $this->motorcycleRepository = $motorcycleRepository;
    }

    /**
     * Delete motorcycle by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        return $this->motorcycleRepository->delete($id);
    }

    /**
     * Get all motorcycle.
     *
     * @return String
     */
    public function getAll()
    {
        $motorcycle = $this->motorcycleRepository->getAll();
        return !$motorcycle->isEmpty() ? $motorcycle->toQuery()->jsonPaginate() : $motorcycle;
    }

    /**
     * Get motorcycle by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->motorcycleRepository->getById($id);
    }

    /**
     * Update motorcycle data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateMotorcycle($data, $id)
    {
        return $this->motorcycleRepository->update($data, $id);
    }

    /**
     * Validate motorcycle data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveMotorcycleData($data)
    {
        return $this->motorcycleRepository->save($data);
    }

}
