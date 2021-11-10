<?php
namespace App\Repositories\Department;

use App\Models\Department;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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
        return Department::find($id);
    }

    public function create($data)
    {
        $department = $this->model::create([
            'name' => $data['name'],
        ]);

        return $department;
    }

    public function update($id, $data)
    {
        $department = $this->model->find($id);
        if($department) {
            $department->update([
                'name' => $data['name'],
            ]);

            return true;
        }

        return false;
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $department = $this->model->where('id', $id);
            $department->delete();

            Db::commit();
            session()->flash('success', 'Xóa phòng ban thành công');
        } catch (\Exception $err) {
            DB::rollBack();

            return redirect()->back()->with('error', $err->getMessage());
        }
       
        
    }
}