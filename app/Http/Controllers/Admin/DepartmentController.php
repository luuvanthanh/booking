<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Services\departments\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentService;
    
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function getDepartment()
    {
        return view(
            'departments.list',
            ['departments' => $this->departmentService->getAll()]
        );
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        try {
            $this->departmentService->create($request->all());

            return redirect()->route('getDepartment')->with(
                'success', 'Thêm phòng ban thành công'
            );
        } catch (\Exception $err) {

            return redirect()->back()->with('erorr', 'Thêm phòng ban thất bại');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view(
            'departments.edit', 
            ['department' => $this->departmentService->find($id),]
        );
    }

    public function update(Request $request, $id)
    {
        try {
            $this->departmentService->update($id, $request->all());

            return redirect()->route('getDepartment')->with(
                'success', 'Update phòng ban thành công'
            );
        } catch (\Exception $err) {

            return redirect()->back()->with('erorr', 'Update phòng ban thất bại');
        }
    }

    public function destroy($id)
    {
        $this->departmentService->delete($id);

        return redirect()->route('getDepartment');
    }
}
