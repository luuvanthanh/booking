<?php
namespace App\Repositories\User;

use App\Models\Booking;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getAll()
    {
        $users = $this->model::paginate(config('app.paginate_user'));

        return $users;
    }

    public function create($data)
    {
        $user = $this->model::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'address' => $data['address'],
            'phone' => $data['phone'],
            'isAdmin' => $data['isAdmin'],
            'department_id' => $data['department_id'],
        ]);
        return $user;
    }

    public function update($id, $data)
    {
        $user = $this->model->find($id);

        if ($user) {
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'address' => $data['address'],
                'phone' => $data['phone'],
                'isAdmin' => $data['isAdmin'],
                'department_id' => $data['department_id'],
            ]);

            return true;
        }

        return false;
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->model->where('id', $id);
            $user->delete();    

            DB::commit();

            session()->flash('success', 'Xóa người dùng thành công');
        } catch (\Exception $err) {
            DB::rollBack();

            return redirect()->back()->with('error', $err->getMessage());
        }
    }
}