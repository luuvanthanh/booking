<?php
namespace App\Repositories\Department;

use App\Models\Department;
use App\Repositories\BaseRepository;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    public function getModel()
    {
        return Department::class;
    }

    public function getDepartment()
    {
        return $this->model->get();
    }

    public function getAll()
    {
        $users = $this->model::paginate(config('app.paginate_department'));

        return $users;
    }

    public function find($id)
    {
        return Department::pluck('name', 'id')->toArray();
    }
}