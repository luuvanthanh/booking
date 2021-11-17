<?php
namespace App\Repositories\Room;

use App\Models\Room;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Room::class;
    }

    public function getRoom()
    {
        $rooms = $this->model->pluck('roomNumber', 'id')->toArray();

          return $rooms;
    }

    public function getAll()
    {
        $rooms = $this->model->paginate(config('app.paginate_room'));

        return $rooms;
    }

    public function create($data)
    {
        $thumbnailPath = null;
        $image = $data['file'];
        $extension = $image->extension();
        $fileName = 'thumbnail_' . time() . '.' . $extension;
        $thumbnailPath = $image->move('thumbnail', $fileName);
        $room = $this->model::create(
            [
                'roomNumber' => $data['roomNumber'],
                'people' => $data['people'],
                'avatar' => $thumbnailPath,
                'status' => 1,
            ]
        );
        return $room;
    }

    public function update($id, $data)
    {
        $room = $this->find($id);
        if ($room) {
            $room->update(
                [
                    'roomNumber' => $data['roomNumber'],
                    'people' => $data['people'],
                    'avatar' => $data['thumb'],
                    'status' => 1,
                ]
            );

            return true;
        }
        
        return false;
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $room = $this->model->where('id', $id);
            $room->delete();

            DB::commit();
            session()->flash('success', 'Xóa phòng họp thành công');
        } catch (\Exception $err) {
            DB::rollBack();

            return redirect()->back()->with('error', $err->getMessage());
        }
    }
}