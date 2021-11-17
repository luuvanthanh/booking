<?php

namespace App\Http\Services;

use App\Models\Booking;
use App\Models\FromTo;
use App\Models\Room;
use App\Repositories\Booking\BookingRepositoryInterface;
use App\Repositories\FromTo\FromToRepositoryInterface;
use App\Repositories\Room\RoomRepositoryInterface;

class HomeService
{
    protected $bookingRepo;
    protected $roomRepo;
    protected $fromToRepo;

    public function __construct(BookingRepositoryInterface $bookingRepo,
        RoomRepositoryInterface $roomRepo,
        FromToRepositoryInterface $fromToRepo
    ) {
          $this->bookingRepo = $bookingRepo;
          $this->roomRepo = $roomRepo;
          $this->fromToRepo = $fromToRepo;
    }

    public function getFromTo()
    {
        $fromTo = $this->fromToRepo->getAll();
          
        return $fromTo;
    }

    public function getBooking()
    {
        $booking = $this->bookingRepo->getAll();

        return $booking;
    }

    public function getRoom()
    {
        $rooms = $this->roomRepo->getRoom();

        return $rooms;
    }
}