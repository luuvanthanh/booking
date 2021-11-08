<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
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
    public function postRoom(BookingRequest $request)
    {  
        $checkRoom = null;
        $checkFromTo = null;
        $checkDate = null;
        $date = date('y-m-d', strtotime($request->date));
        $booking =DB::table('bookings')->where('room_id', $request->room_id)->get();
        foreach ($booking as $book) {
            $checkRoom = $book->room_id;
        }
        // dd($checkRoom);
        $booking =DB::table('bookings')->where('date', $date)->get();
        foreach ($booking as $book) {
            $checkDate = $book->date;
        }
        // dd($checkDate);
        $booking =DB::table('bookings')->where('from_to', $request->from_to)->get();
        foreach ($booking as $book) {
            $checkFromTo = $book->from_to;
        }
        // dd($checkFromTo);
        $data = [
            'room_id' => $request->room_id,
            'user_id' => Auth::user()->id,
            'date' => $date,
            'duration' => $request->duration,
            'attendess' => $request->attendess,
            'from_to' => $request->from_to,
        ];
        $users = Auth::user()->email;
        $message = [];
        Booking::create($data);
        SendEmail::dispatch($message, $users)->delay(now()->addMinute(1));

        return redirect()->back()->with('success', 'Bạn đã đặt phòng thành công');
        // if ($checkRoom != null) {
        //     if ($checkDate != null) {
        //         if ($checkFromTo != null) {
    
        //             return redirect()->back()->with('error', 'Thời gian này đã được chọn');
        //         } else {
        //             Booking::create($data);
                    
        //             return redirect()->back()->with('success', 'Bạn đã đặt phòng thành công');
        //         }     
        //     } else {
        //         Booking::create($data);
                    
        //         return redirect()->back()->with('success', 'Bạn đã đặt phòng thành công');
        //     }
        // }else {
        //     Booking::create($data);

        //     return redirect()->back()->with('success', 'Bạn đã đặt phòng thành công');
        // }
    }

    public function getRoom($idRoom, $date)
    {
        $date = date('Y-m-d', strtotime($date));
        $collection = Booking::where('room_id', $idRoom)->get();
        $getDate = Booking::where('date', $date)->get();
        $fromTo = FromTo::Pluck('from_to');
        $fromTos = FromTo::all();
        $result = ''; 
        $isEmpty = $collection->isEmpty();
        $isEmptyDate = $getDate->isEmpty();
        if ($isEmpty == false) {
            if ($isEmptyDate == false) {
                $getFromToByDate = Booking::where('date', $date)->where('room_id', $idRoom)->Pluck('from_to');
                    $result = $fromTo->diff($getFromToByDate);
                    foreach ($result as $r) {
                        echo '<label class="btn btn-outline-secondary" >';
                        echo '<input type="radio" class="from" value="'.$r.'" name="from_to">';
                        echo $r;
                        echo '</label>';    
                    } 
            }else {
                foreach ($fromTos as $from) {
                    echo '<label class="btn btn-outline-secondary" >';
                    echo '<input type="radio" class="from" value="'.$from->from_to.'" name="from_to">';
                    echo $from->from_to;
                    echo '</label>';
                }
            }
        } 
        else {
            foreach ($fromTos as $from) {
                echo '<label class="btn btn-outline-secondary" >';
                echo '<input type="radio" class="from" value="'.$from->from_to.'" name="from_to">';
                echo $from->from_to;
                echo '</label>';
            }
        }
    }
}