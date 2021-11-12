<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Http\Services\BookingService;
use App\Http\Services\users\UserService;
use App\Jobs\SendEmail;
use App\Models\Booking;
use App\Models\FromTo;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function postRoom(BookingRequest $request)
    {  
        $this->bookingService->bookRoom($request->all());

        return back();
    }

    public function getRoom($idRoom, $date)
    {
        $this->bookingService->checkRoom($idRoom, $date);
    }
}