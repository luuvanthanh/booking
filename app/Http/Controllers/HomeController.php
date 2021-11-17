<?php

namespace App\Http\Controllers;

use App\Http\Services\HomeService;
use App\Models\Booking;
use App\Models\FromTo;
use App\Models\Room;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        return view(
            'manager', [
            'bookings' => $this->homeService->getBooking(),
            'rooms' => $this->homeService->getRoom(),
            'fromTos' => $this->homeService->getFromTo(),]
        );
    }
}
