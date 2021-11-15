<?php

namespace App\Http\Services\departments;

use App\Models\Department;
use App\Repositories\Department\DepartmentRepositoryInterface;

class DepartmentService 
{
    protected $departmentRepo;

    public function __construct(DepartmentRepositoryInterface $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }

    public function getDepartment()
    {
        return $this->departmentRepo->getDepartment();
    }

    public function find($id)
    {
        $departments = $this->departmentRepo->find($id);

        return $departments;
    }

    public function getAll()
    {
        $departments = $this->departmentRepo->getAll();

        return $departments;
    }

    public function create($data)
    {
        $department = $this->departmentRepo->create($data);

        return $department;
    }

    public function update($id, $data)
    {
        $department = $this->departmentRepo->update($id, $data);

        return $department;
    }

    public function delete($id)
    {
        $department = $this->departmentRepo->delete($id);

        return $department;
    }
}