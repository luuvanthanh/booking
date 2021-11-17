<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestUser;
use App\Http\Services\departments\DepartmentService;
use App\Http\Services\users\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userRepo;
    protected $departmentRepo;
    protected $userService;
    protected $departmentService;

    public function __construct(UserService $userService,
        DepartmentService $departmentService
    ) {
        $this->userService = $userService;
        $this->departmentService = $departmentService;
    }

    public function getUser()
    {
        return view(
            'users.list', ['users' => $this->userService->getAll()]
        );
    }

    public function create()
    {
        return view(
            'users.create', ['departments' => $this->departmentService->getDepartment()]
        );
    }

    public function store(StoreRequestUser $request)
    {
        try {
            $user = $this->userService->create($request->all());

            return redirect()->route('getUser')->with(
                'success', 'Thêm người dùng thành công'
            );
        } catch (\Exception $err) {

            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $user = $this->userService->find($id);
            $departments = $this->departmentService->getDepartment();

            return view(
                'users.edit', [
                'user' => $user,
                'departments' => $departments]
            );
        } catch (\Exception $err) {
            
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $this->userService->update($id, $request->all());

            return redirect()->route('getUser')->with(
                'success', 'Update người dùng thành công'
            );
        } catch (\Exception $err) {

            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function destroy($id)
    {
        $this->userService->delete($id);

        return redirect()->route('getUser');
    }
}
