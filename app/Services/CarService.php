<?php

namespace App\Services;

use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Support\Facades\DB;

class CarService
{
    /**
     * @var $carRepository
     */
    protected $carRepository;

    /**
     * CarService constructor.
     *
     * @param CarRepository $carRepository
     */
    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * Delete car by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        return $this->carRepository->delete($id);
    }

    /**
     * Get all car.
     *
     * @return String
     */
    public function getAll()
    {
        $car = $this->carRepository->getAll();
        return !$car->isEmpty() ? $car->toQuery()->jsonPaginate() : $car;
    }

    /**
     * Get car by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->carRepository->getById($id);
    }

    /**
     * Update car data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateCar($data, $id)
    {
        return $this->carRepository->update($data, $id);
    }

    /**
     * Validate car data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveCarData($data)
    {
        return $this->carRepository->save($data);
    }

}
