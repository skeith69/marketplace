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
}
