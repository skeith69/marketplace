<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    /**
     * Store repository.
     *
     * @var App\Repositories\StoreRepository
     */
    protected $store;

    /**
     * Create new instance of store controller.
     *
     * @param StoreRepository store Store repository
     */
    public function __construct(StoreRepository $store)
    {
        $this->store = $store;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! $data = StoreResource::collection($this->store->paginate())) {
            return response()->json([
                'message' => 'Failed to retrieve resource'
            ], 400);
        }

        return $data;
    }

    /**
     * Retrieve products for certain store using specified store id.
     *
     * @param  int $storeId Store id.
     * @return \Illuminate\Http\Response
     */
    public function products($storeId)
    {
        if (! $products = $this->store->products($storeId, request()->per_page)) {
            return response()->json([
                'message' => 'Resources does not exist'
            ], 400);
        }

        return response()->json([
            'message'  => 'Resources successfully retrieve',
            'products' => $products
        ], 200);
    }
}
