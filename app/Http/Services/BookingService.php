<?php

namespace App\Http\Services;

use App\Jobs\SendEmail;
use App\Models\Booking;
use App\Models\FromTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingService 
{
    public function bookRoom($data)
    {
        $checkRoom = null;
        $checkFromTo = null;
        $checkDate = null;
        $date = date('Y-m-d', strtotime($data['date']));
        $booking =DB::table('bookings')->where('room_id', $data['room_id'])->get();
        foreach ($booking as $book) {
            $checkRoom = $book->room_id;
        }
        $booking =DB::table('bookings')->where('date', $date)->get();
        foreach ($booking as $book) {
            $checkDate = $book->date;
        }
        $booking =DB::table('bookings')->where('from_to', $data['from_to'])->get();
        foreach ($booking as $book) {
            $checkFromTo = $book->from_to;
        }
        $dataBooking = [master
            'room_id' => $data['room_id'],
            'user_id' => Auth::user()->id,
            'date' => $date,
            'duration' => $data['duration'],
            'attendess' => $data['attendess'],
            'from_to' => $data['from_to'],
        ];
        $users = Auth::user()->email;
        $message = [];
        if ($checkRoom != null) {
            if ($checkDate != null) {
                if ($checkFromTo != null) {
    
                    return redirect()->back()->with('error', 'Thời gian này đã được chọn');
                } else {
                    Booking::create($data);
                    SendEmail::dispatch($message, $users);

                    
                    return redirect()->back()->with('success', 'Bạn đã đặt phòng thành công');
                }     
            } else {
                Booking::create($data);
                SendEmail::dispatch($message, $users);
                    
                return redirect()->back()->with('success', 'Bạn đã đặt phòng thành công');
            }
        }else {
            Booking::create($data);
            SendEmail::dispatch($message, $users);

            return redirect()->back()->with('success', 'Bạn đã đặt phòng thành công');
        }
        try {
            Booking::create($dataBooking);
            SendEmail::dispatch($message, $users);

            return redirect()->back()->with('success', 'Bạn đã đặt phòng thành công');
        } catch (\Exception $err) {
            session()->flash('erorr', 'Đặt phòng thất bại');
            Log::info($err->getMessage());
            
            return false;
        }

        return true;
    }

    public function checkRoom($idRoom, $date)
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
                    if (!empty($result)) {
                        foreach ($result as $r) {
                            echo '<label class="btn btn-outline-secondary" >';
                            echo '<input type="radio" class="from" value="'.$r.'" name="from_to">';
                            echo $r;
                            echo '</label>';    
                        } 
                    }
            }else {
                if (!empty($fromTos)) {
                    foreach ($fromTos as $from) {
                        echo '<label class="btn btn-outline-secondary" >';
                        echo '<input type="radio" class="from" value="'.$from->from_to.'" name="from_to">';
                        echo $from->from_to;
                        echo '</label>';
                    }
                }
            }
        } 
        else {
            if (!empty($fromTos)) {
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