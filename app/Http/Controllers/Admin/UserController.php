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

    public function __construct(
        UserService $userService,
        DepartmentService $departmentService,
    )
    {
        $this->userService = $userService;
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.list', [
            'users' => $this->userService->getAll(),
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
            'departments' => $this->departmentService->getDepartment(),
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
            $user = $this->userService->create($request->all());

            return redirect()->route('user.index')->with('success', 'Thêm người dùng thành công');
        } catch (\Exception $err) {

            return redirect()->back()->with('error', $err->getMessage());
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
            $user = $this->userService->find($id);
            $departments = $this->departmentService->getDepartment();

            return view('users.edit', [
                'user' => $user,
                'departments' => $departments,
            ]);
        } catch (\Exception $err) {
            
            return redirect()->back()->with('error', $err->getMessage());
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
            $user = $this->userService->update($id, $request->all());

            return redirect()->route('user.index')->with('success', 'Update người dùng thành công');
        } catch (\Exception $err) {

            return redirect()->back()->with('error', $err->getMessage());
            Log::info($err->getMessage());
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
        $this->userService->delete($id);

        return redirect()->route('user.index');
    }
}
