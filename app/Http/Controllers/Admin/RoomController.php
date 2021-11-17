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
  
    public function getRoom()
    {
        return view(
            'rooms.list', ['rooms' => $this->roomService->getAll()]
        );
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(StoreRoomRequest $request)
    {
        try {
            $this->roomService->create($request->all());

            return redirect()->route('getRoom')->with(
                'success', 'Thêm phòng họp thành công'
            );
        } catch (\Exception $err) {

            return redirect()->back()->with('erorr', 'Thêm phòng họp thất bại');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view(
            'rooms.edit', ['room' => $this->roomService->find($id)]
        );
    }

    public function update(UpdateRequestRoom $request, $id)
    {
        try {
            $this->roomService->update($id, $request->all());

            return redirect()->route('getRoom')->with(
                'success', 'Update phòng họp thành công'
            );
        } catch (\Exception $err) {
            
            return redirect()->back()->with('erorr', 'Update phòng họp thất bại');
        }
    }

    public function destroy($id)
    {
        $this->roomService->delete($id);

        return redirect()->route('getRoom');
    }
}
