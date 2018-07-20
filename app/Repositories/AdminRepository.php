<?php

namespace App\Repositories;

use App\Admin;

class AdminRepository extends Repository
{
    /**
     * Create new instance of admin repository.
     *
     * @param Admin admin Admin model
     */
    public function __construct(Admin $admin)
    {
        parent::__construct($admin);
        $this->admin = $admin;
    }

    /**
     * Store the data in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function store($request)
    {
        return $this->admin->create([
            'store_id' => $request->store_id,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);
    }

    /**
     * Toggle to add or remove role on certain admin.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function toggleRole($request)
    {
        if ($this->admin->findOrFail($request->admin_id)->roles()->toggle($request->role_id)) {
            return true;
        }

        return false;
    }

    /**
     * Retrieve assigned roles for specific admin using id.
     *
     * @param  int $id Permission id
     * @return array
     */
    public function getAssignedRoles($id)
    {
        return $this->admin->where('id', $id)->with([
            'roles' => function ($query) {
                $query->select('id', 'name');
            }
        ])->first()->roles;
    }
}
