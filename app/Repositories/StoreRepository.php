<?php

namespace App\Repositories;

use App\Store;

class StoreRepository extends Repository
{
    /**
     * Create new instance of store repository.
     *
     * @param Store store Store model
     */
    public function __construct(Store $store)
    {
        parent::__construct($store);
        $this->store = $store;
    }
}
