<?php

namespace App\Repositories;

use App\Product;
use App\Store;

class StoreRepository extends Repository
{
    /**
     * Product model.
     *
     * @var App\Product
     */
    protected $product;

    /**
     * Create new instance of store repository.
     *
     * @param Store $store Store model
     * @param Product $product Product model
     */
    public function __construct(Store $store, Product $product)
    {
        parent::__construct($store);
        $this->store = $store;
        $this->product = $product;
    }

    public function products($storeId, $length = 10)
    {
        return $this->product->where('store_id', $storeId)->with('store')->paginate($length);
    }
}
