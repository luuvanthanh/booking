<?php

namespace App\Http\Services\rooms;

use App\Repositories\Room\RoomRepositoryInterface;

class RoomService
{
    protected $roomRepo;

    public function __construct(RoomRepositoryInterface $roomRepo)
    {
        $this->roomRepo = $roomRepo;
    }

    public function find($id)
    {
        $room = $this->roomRepo->find($id);

        return $room;
    }

    public function getAll()
    {
        $rooms = $this->roomRepo->getAll();

        return $rooms;
    }

    public function create($data)
    {
        $room = $this->roomRepo->create($data);

        return $room;
    }

    public function update($id, $data)
    {
        $room = $this->roomRepo->update($id, $data);

        return $room;
    }

    public function delete($id)
    {
        $room = $this->roomRepo->delete($id);

        return $room;
    }
}