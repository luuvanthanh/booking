<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use App\Models\User;
use App\Repositories\Department\DepartmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    protected $departmentRepo;

    public function __construct(DepartmentRepositoryInterface $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('departments.list',[
            'departments' => $this->departmentRepo->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        try {
            $department = Department::create([
                'name' => $request->name,
            ]);

            return redirect()->route('department.index')->with('success', 'Thêm phòng ban thành công');
        } catch (\Exception $err) {
            
            session()->flash('erorr', 'Thêm phòng ban thất bại');
            Log::info($err->getMessage());
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
        $department = Department::find($id);
        return view('departments.edit', [
            'department' => $department,
        ]);
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
            $department = Department::find($id);
            $department->name = $request->name;
            $department->save();

            return redirect()->route('department.index')->with('success', 'Update phòng ban thành công');
        } catch (\Exception $err) {

            session()->flash('erorr', 'Update phòng ban thất bại');
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
        try {
            $user = User::find($id);
            $department = Department::find($id);
            $user->delete();
            $department->delete();

            return redirect()->route('department.index')->with('success', 'Xóa phòng ban thành công');
        } catch (\Exception $err) {

            session()->flash('erorr', 'Xóa phòng ban thất bại');
            Log::info($err->getMessage());
        }
    }
}
