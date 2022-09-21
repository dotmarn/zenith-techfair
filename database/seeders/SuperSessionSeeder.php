<?php

namespace Database\Seeders;

use App\Models\SuperSession;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event_time = [
            "2:00 - 3:00",
            "3:30 - 4:30"
        ];

        $event_date = [
            "23rd Nov, 2022",
            "24th Nov, 2022"
        ];

        $data = [
            (object)[
                "title" => "Master Class 1",
                "max_participants" => 5
            ],
            (object)[
                "title" => "Master Class 2",
                "max_participants" => 3
            ],
            (object)[
                "title" => "Master Class 3",
                "max_participants" => 2
            ],
            (object)[
                "title" => "Master Class 4",
                "max_participants" => 2
            ]
        ];

        foreach($data as $key => $value) {
            SuperSession::updateOrCreate([
                "title" => $value->title
            ],[
                'max_participants' => $value->max_participants,
                'event_date' => $event_date,
                'event_time' => $event_time
            ]);
        }
    }
}
