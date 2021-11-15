<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRequestRoom;
use App\Http\Services\rooms\RoomService;
use App\Repositories\Room\RoomRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rooms.list',[
            'rooms' => $this->roomService->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        try {
            $this->roomService->create($request->all());

            return redirect()->route('room.index')->with('success', 'Thêm phòng họp thành công');
        } catch (\Exception $err) {

            session()->flash('erorr', 'Thêm phòng họp thất bại');
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
        return view('rooms.edit',[
            'room' => $this->roomService->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestRoom $request, $id)
    {
        try {
            $this->roomService->update($id, $request->all());

            return redirect()->route('room.index')->with('success', 'Update phòng họp thành công');
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
        $this->roomService->delete($id);

        return redirect()->route('room.index');
    }
}
