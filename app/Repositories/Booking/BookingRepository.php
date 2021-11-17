<?php
namespace App\Repositories\Booking;

use App\Jobs\SendEmail;
use App\Models\Booking;
use App\Models\FromTo;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    public function getModel()
    {
        return Booking::class;
    }

    public function getAll()
    {
        $booking = $this->model->all();

        return $booking;
    }

    public function bookRoom($data)
    {
        $checkRoom = null;
        $checkFromTo = null;
        $checkDate = null;
        $date = date('Y-m-d', strtotime($data['date']));
        $booking = $this->model->where('room_id', $data['room_id'])->get();
        foreach ($booking as $book) {
            $checkRoom = $book->room_id;
        }
        $booking = $this->model->where('date', $date)->get();
        foreach ($booking as $book) {
            $checkDate = $book->date;
        }
        $booking = $this->model->where('from_to', $data['from_to'])->get();
        foreach ($booking as $book) {
            $checkFromTo = $book->from_to;
        }
        $data = [
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
                } 
                $this->model->create($data);
                SendEmail::dispatch($message, $users);

                return redirect()->back()->with('success', 'Bạn đã đặt phòng thành công');
            }
            $this->model->create($data);
            SendEmail::dispatch($message, $users);
                    
            return redirect()->back()->with('success', 'Bạn đã đặt phòng thành công');
        }
        $this->model->create($data);
        SendEmail::dispatch($message, $users);

        return redirect()->back()->with('success', 'Bạn đã đặt phòng thành công');
    }

    public function checkRoom($idRoom, $date)
    {
        $date = date('Y-m-d', strtotime($date));
        $collection = $this->model->where('room_id', $idRoom)->get();
        $getDate = $this->model->where('date', $date)->get();
        $fromTo = FromTo::Pluck('from_to');
        $fromTos = FromTo::all();
        $result = ''; 
        $isEmpty = $collection->isEmpty();
        $isEmptyDate = $getDate->isEmpty();
        if ($isEmpty == false) {
            if ($isEmptyDate == false) {
                $getFromToByDate = $this->model->where('date', $date)->where('room_id', $idRoom)->Pluck('from_to');
                    $result = $fromTo->diff($getFromToByDate);
                foreach ($result as $r) {
                    echo '<label class="btn btn-outline-secondary" >';
                    echo '<input type="radio" class="from" value="'.$r.'" name="from_to">';
                    echo $r;
                    echo '</label>';    
                } 
            }
            foreach ($fromTos as $from) {
                echo '<label class="btn btn-outline-secondary" >';
                echo '<input type="radio" class="from" value="'.$from->from_to.'" name="from_to">';
                echo $from->from_to;
                echo '</label>';
            }
        } 
        foreach ($fromTos as $from) {
            echo '<label class="btn btn-outline-secondary" >';
            echo '<input type="radio" class="from" value="'.$from->from_to.'" name="from_to">';
            echo $from->from_to;
            echo '</label>';
        }
    }
}