<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Category repository.
     *
     * @var App\Repositories\CategoryRepository
     */
    protected $category;
    
    /**
     * Create new instance of category controller.
     *
     * @param CategoryRepository category Category repository
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! $data = CategoryResource::collection($this->category->paginate())) {
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
            'name'        => 'required|min:2|max:255',
            'description' => 'required|min:2|max:500'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message'  => 'Validation failed.',
                'errors'   => $validator->errors()
            ], 400);
        }
    
        if (! $this->category->store($request)) {
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
        if (! $category = $this->category->findOrFail($id)) {
            return response()->json([
                'response' => false,
                'message'  => 'Resource does not exist.'
            ], 400);
        }
    
        return response()->json([
            'response'    => true,
            'message'     => 'Resource successfully retrieve.',
            'category' => $category
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
            'name'        => 'required|min:2|max:255',
            'description' => 'required|min:2|max:500'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message'  => 'Validation failed.',
                'errors'   => $validator->errors()
            ], 400);
        }
    
        if (! $this->category->update($request, $id)) {
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
        if (! $this->category->findOrFail($id)->delete()) {
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
        if (! $this->category->restore($id)) {
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
        if (! $this->category->forceDestroy($id)) {
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
        if (! $categories = $this->category->all()) {
            return response()->json([
                'response' => false,
                'message'  => 'Resources does not exist.'
            ], 400);
        }

        return response()->json([
            'response'   => true,
            'message'    => 'Resources successfully retrieve.',
            'categories' => $categories
        ], 200);
    }
}
