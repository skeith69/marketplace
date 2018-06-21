<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                'response' => false,
                'message'  => 'Failed to retrieve resource.'
            ], 400);
        }
    
        return $data;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'   => 'image|max:5000',
            'name'    => 'required|min:2|max:255',
            'address' => 'required|min:2|max:500'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message'  => 'Validation failed.',
                'errors'   => $validator->errors()
            ], 400);
        }
    
        if (! $this->store->store($request)) {
            return response()->json([
                'response' => false,
                'message'  => 'Failed to store resource.'
            ], 500);
        }
    
        return response()->json([
            'response' => true,
            'message'  => 'Resource successfully stored.'
        ], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! $store = $this->store->findOrFail($id)) {
            return response()->json([
                'response' => false,
                'message'  => 'Resource does not exist.'
            ], 400);
        }
    
        return response()->json([
            'response'    => true,
            'message'     => 'Resource successfully retrieve.',
            'store' => $store
        ], 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image'   => 'image|max:5000',
            'name'    => 'required|min:2|max:255',
            'address' => 'required|min:2|max:500'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message'  => 'Validation failed.',
                'errors'   => $validator->errors()
            ], 400);
        }
    
        if (! $this->store->update($request, $id)) {
            return response()->json([
                'response' => false,
                'message'  => 'Failed to update resource.'
            ], 500);
        }
    
        return response()->json([
            'response' => true,
            'message'  => 'Resource successfully updated.'
        ], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $this->store->findOrFail($id)->delete()) {
            return response()->json([
                'response' => false,
                'message'  => 'Failed to delete resource.'
            ], 400);
        }
    
        return response()->json([
            'response' => true,
            'message'  => 'Resource successfully deleted.'
        ], 200);
    }
    
    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! $this->store->restore($id)) {
            return response()->json([
                'response' => false,
                'message'  => 'Failed to restore resource.'
            ], 400);
        }
    
        return response()->json([
            'response' => true,
            'message'  => 'Resource successfully restored.'
        ], 200);
    }
    
    /**
     * Forcefully remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy($id)
    {
        if (! $this->store->forceDestroy($id)) {
            return response()->json([
                'response' => false,
                'message'  => 'Failed to permanently delete resource.'
            ], 400);
        }
    
        return response()->json([
            'response' => true,
            'message'  => 'Resource successfully deleted permanently.'
        ], 200);
    }

    /**
     * Retrieve all resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        if (! $stores = $this->store->all()) {
            return response()->json([
                'response' => false,
                'message'  => 'Resources does not exist.'
            ], 400);
        }

        return response()->json([
            'response' => true,
            'message'  => 'Resources successfully retrieve.',
            'stores'   => $stores
        ], 200);
    }
}
