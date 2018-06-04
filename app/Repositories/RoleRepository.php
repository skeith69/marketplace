<?php

namespace App\Repositories;

use App\Role;

class RoleRepository extends Repository
{
    /**
     * Create new instance of role repository.
     *
     * @param Role role Role model
     */
    public function __construct(Role $role)
    {
        parent::__construct($role);
        $this->role = $role;
    }

    /**
     * Toggle to add or remove persmission on certain role.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function togglePermission($request)
    {
        if ($this->role->findOrFail($request->role_id)->permissions()->toggle($request->permission_id)) {
            return true;
        }

        return false;
    }

    /**
     * Retrieve assigned permissions for specific role using id.
     *
     * @param  int $id Role id
     * @return array
     */
    public function getAssignedPermissions($id)
    {
        return $this->role->where('id', $id)->with([
            'permissions' => function ($query) {
                $query->select('id');
            }
        ])->first()->permissions;
    }
}
