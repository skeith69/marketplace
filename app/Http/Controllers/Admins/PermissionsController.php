<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionsController extends Controller
{
    /**
     * Permission repository.
     *
     * @var App\Repositories\PermissionRepository
     */
    protected $permission;
    
    /**
     * Create new instance of permission controller.
     *
     * @param PermissionRepository permission Permission repository
     */
    public function __construct(PermissionRepository $permission)
    {
        $this->permission = $permission;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! $data = PermissionResource::collection($this->permission->paginate())) {
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
            'name'         => 'required|min:2|max:255',
            'display_name' => 'required|min:2|max:255',
            'description'  => 'required|min:2|max:500'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message'  => 'Validation failed.',
                'errors'   => $validator->errors()
            ], 400);
        }
    
        if (! $this->permission->store($request)) {
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
        if (! $permission = $this->permission->findOrFail($id)) {
            return response()->json([
                'response' => false,
                'message'  => 'Resource does not exist.'
            ], 400);
        }
    
        return response()->json([
            'response'    => true,
            'message'     => 'Resource successfully retrieve.',
            'permission' => $permission
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
            'name'         => 'required|min:2|max:255',
            'display_name' => 'required|min:2|max:255',
            'description'  => 'required|min:2|max:500'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message'  => 'Validation failed.',
                'errors'   => $validator->errors()
            ], 400);
        }
    
        if (! $this->permission->update($request, $id)) {
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
        if (! $this->permission->findOrFail($id)->delete()) {
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
        if (! $this->permission->restore($id)) {
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
        if (! $this->permission->forceDestroy($id)) {
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
        if (! $permissions = $this->permission->all()) {
            return response()->json([
                'response' => false,
                'message'  => 'Resources does not exist.'
            ], 400);
        }

        return response()->json([
            'response'    => true,
            'message'     => 'Resources successfully retrieve.',
            'permissions' => $permissions
        ], 200);
    }
}
