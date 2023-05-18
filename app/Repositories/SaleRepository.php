<?php

namespace App\Repositories;

use App\Models\Sale;

class SaleRepository extends BaseRepository
{
    /**
     * SaleRepository constructor.
     *
     * @param Sale $sale
     */
    public function __construct(Sale $sale)
    {
        $this->model = $sale;
    }

}
