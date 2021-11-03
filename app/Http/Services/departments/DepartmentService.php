<?php

namespace App\Http\Services\departments;

use App\Models\Department;

class DepartmentService 
{
    public function getDepartment()
    {
        return Department::all();
    }
}