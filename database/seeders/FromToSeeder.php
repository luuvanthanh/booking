<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FromToSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['from_to' => '08:00 - 09:00'],
            ['from_to' => '09:00 - 10:00'],
            ['from_to' => '10:00 - 11:00'],
            ['from_to' => '11:00 - 12:00'],
            ['from_to' => '12:00 - 13:00'],
            ['from_to' => '13:00 - 14:00'],
            ['from_to' => '14:00 - 15:00'],
            ['from_to' => '15:00 - 16:00'],
            ['from_to' => '16:00 - 17:00'],
            ['from_to' => '17:00 - 18:00'],
            ['from_to' => '18:00 - 19:00'],
            ['from_to' => '19:00 - 20:00'],
            ['from_to' => '20:00 - 21:00'],
            ['from_to' => '21:00 - 22:00'],
            ['from_to' => '22:00 - 23:00'],
        ];
        DB::table('from_tos')->insert($data);
    }
}
