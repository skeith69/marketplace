<?php

namespace App\Repositories;

use App\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleRepository extends Repository
{
    /**
     * Create new instance of project repository.
     *
     * @param Sale $sale Sale repository.
     */
    public function __construct(Sale $sale)
    {
        parent::__construct($sale);
        $this->sale = $sale;
    }

    /**
     * Retrieve today sales.
     *
     * @return object
     */
    public function todaySales()
    {
        return $this->sale->select(DB::Raw('SUM(amount) as total'))
            ->whereBetween('created_at', [Carbon::today(), Carbon::now()->endOfDay()])
            ->where('store_id', request()->store_id ? request()->store_id : auth('api')->user()->store_id)
            ->first()->total;
    }

    /**
     * Retrieve current week sales.
     *
     * @return object
     */
    public function currentWeekSales()
    {
        return $this->sale->select(DB::Raw('SUM(amount) as total'))
            ->whereBetween('created_at', [Carbon::today()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('store_id', request()->store_id ? request()->store_id : auth('api')->user()->store_id)
            ->first()->total;
    }

    /**
     * Retrieve current month sales.
     *
     * @return object
     */
    public function currentMonthSales()
    {
        return $this->sale->select(DB::Raw('SUM(amount) as total'))
            ->whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->where('store_id', request()->store_id ? request()->store_id : auth('api')->user()->store_id)
            ->first()->total;
    }
}
