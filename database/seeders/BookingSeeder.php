<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        for ($i=0; $i < 5; $i++) { 
            DB::table('bookings')->insert([
                'room_id' => 1,
                'user_id' => 1,
                'date' => $date,
                'duration' => 1,
                'attendess' => $i,
                'from_to' => "8:00 - 9:00",
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
