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
     * Create pagination with filters for the resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer                   $length
     * @param  string                    $orderBy
     * @param  boolean                   $removePage
     * @return array json object
     */
    public function paginateWithFilters(
        $request = null,
        $length = 10,
        $orderBy = 'desc',
        $removePage = true
    ) {
        return $this->model->filter($request)
            ->where('store_id', auth('api')->user()->store_id)
            ->with('category', 'store')
            ->orderBy('created_at', $orderBy)
            ->paginate($length)
            ->withPath(
                $this->model->createPaginationUrl($request, $removePage)
            );
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
