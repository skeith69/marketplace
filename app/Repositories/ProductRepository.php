<?php

namespace App\Repositories;

use App\Product;

class ProductRepository extends Repository
{
    /**
     * Create new instance of product repository.
     *
     * @param Product product Product model
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
        $this->product = $product;
    }
}
