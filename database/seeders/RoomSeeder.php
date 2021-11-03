<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 0;
        for ($i=0; $i < 10; $i++) { 
            DB::table('rooms')->insert([
                'roomNumber' => $i,
                'people' => 1,
                'avatar' => Str::random(10),
                'status' => 1,
            ]);
        }
    }
}
