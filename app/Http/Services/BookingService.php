<?php

namespace App\Http\Services;

use App\Models\Booking;
use App\Models\FromTo;
use App\Repositories\Booking\BookingRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingService
{
    protected $bookingRepo;

    public function __construct(BookingRepositoryInterface $bookingRepo)
    {
        $this->bookingRepo = $bookingRepo;
    }

    public function bookRoom($data)
    {
        $booking = $this->bookingRepo->bookRoom($data);

        return $booking;
    }

    public function checkRoom($idRoom, $date)
    {
        $checkRoom = $this->bookingRepo->checkRoom($idRoom, $date);

        return $checkRoom;
    }
}