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
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    }
}
