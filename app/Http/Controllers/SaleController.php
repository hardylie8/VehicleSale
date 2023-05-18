<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleSaveRequest;
use App\Http\Resources\SaleCollection;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use App\Services\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * @var SaleService
     */
    protected $saleService;

    /**
     * SaleController Constructor
     *
     * @param SaleService $saleService
     *
     */
    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return (new SaleCollection($this->saleService->getAll($request)))
            ->additional(
                [
                    'success' => 'success',
                    'message' => 'Data Has been successfully retrieved',
                ]
            );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleSaveRequest $request)
    {

        $result = $this->saleService->saveSaleData($request);

        return (new SaleResource($result))
            ->additional(
                [
                    'status' => 201,
                    'message' => 'Data Has been successfully  Created',
                ]
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return (new SaleResource($this->saleService->getById($sale->getKey())))
            ->additional(
                [
                    'success' => 'success',
                    'message' => 'Data Has been successfully retrieved',
                ]
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleSaveRequest $request, Sale $sale)
    {
        $result = $this->saleService->updateSale($request, $sale->getKey());

        return (new SaleResource($result))
            ->additional(
                [
                    'status' => 201,
                    'message' => 'Data Has been successfully Updated',
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $result = $this->saleService->deleteById($sale->getKey());
        return (new SaleResource($result))
            ->additional(
                [
                    'status' => 200,
                    'message' => 'Data Has been successfully deleted',
                ]
            );
    }
}
