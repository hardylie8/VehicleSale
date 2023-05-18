<?php

namespace App\Services;

use App\Models\Sale;
use App\Repositories\SaleRepository;
use App\Repositories\VehicleRepository;
use Illuminate\Support\Facades\DB;

class SaleService
{
    /**
     * @var $saleRepository
     */
    protected $saleRepository;

    /**
     * SaleService constructor.
     *
     * @param SaleRepository $saleRepository
     */
    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    /**
     * Delete sale by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        $result = $this->saleRepository->delete($id);
        return $result;
    }

    /**
     * Get all sale.
     *
     * @return String
     */
    public function getAll($request)
    {
        $sale = $this->saleRepository->getAll()->with('vehicle');
        if ($request->has('vehicle_id')) {
            $sale->where('vehicle_id', $request->input('vehicle_id'));
        }
        return $sale->jsonPaginate();
    }

    /**
     * Get sale by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->saleRepository->getById($id);
    }

    /**
     * Update sale data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateSale($data, $id)
    {
        $result = $this->saleRepository->update($data, $id);

        return $result;

    }

    /**
     * Validate sale data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveSaleData($data)
    {
        $result = $this->saleRepository->save($data);
        $vehicleRepository = app(VehicleRepository::class);
        $vehicleRepository->decreaseStock($data->vehicle_id, $data->total);
        return $result;
    }

}
