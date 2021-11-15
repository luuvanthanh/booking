<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FromTo;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $fromTo = FromTo::all();
        $booking = Booking::all();
        $rooms = Room::pluck('roomNumber', 'id')->toArray();
        return view('manager', [
            'bookings' => $booking,
            'rooms' => $rooms,
            'fromTos' => $fromTo,
        ]);
    }
}
