<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestUser;
use App\Models\Department;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Department\DepartmentRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepo;
    protected $departmentRepo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        DepartmentRepositoryInterface $departmentRepo
    )
    {
        $this->userRepo = $userRepo;
        $this->departmentRepo = $departmentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.list', [
            'users' => $this->userRepo->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $departments = Department::all();
        // return view('users.create', compact('departments'));
        return view('users.create', [
            'departments' => $this->departmentRepo->getDepartment(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestUser $request)
    {
        try {
            $user = $this->userRepo->create($request->all());

            return redirect()->route('user.index')->with('success', 'Thêm người dùng thành công');
        } catch (\Exception $err) {

            return back()-with('erorr', 'Thêm người dùng thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = $this->userRepo->find($id);
            $departments = $this->departmentRepo->find($id);

            return view('users.edit', compact('user', 'departments'));
        } catch (\Exception $err) {
            return back()-with('erorr', 'Thất bại');
        }
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
        try {
            $user = $this->userRepo->update($id, $request->all());

            return redirect()->route('user.index')->with('success', 'Update người dùng thành công');
        } catch (\Exception $err) {

            return back()-with('erorr', 'Thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepo->delete($id);

        return redirect()->route('user.index');
    }
}
