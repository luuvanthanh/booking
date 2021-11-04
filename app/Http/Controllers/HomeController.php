<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $booking = Booking::all();
        return view('manager', compact('booking'));
    }
}
