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

    /**
     * Create pagination for the resources.
     *
     * @param  integer $length
     * @return array json object
     */
    public function paginate($length = 10)
    {
        return $this->product->with('category')->paginate($length);
    }

    /**
     * Find the resource using the specified id or else fail.
     *
     * @param  int $id
     * @return json object
     */
    public function findOrFail($id)
    {
        return $this->product->with('store', 'category')->findOrFail($id);
    }
}
