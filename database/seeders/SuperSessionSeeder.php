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
            "3:00 - 5:00"
        ];

        $event_date = [
            "22nd Nov, 2023",
            "23rd Nov, 2023"
        ];

        $data = [
            (object)[
                "title" => "Blockchain Technology - Applications & Challenges",
                "max_participants" => 500
            ],
            (object)[
                "title" => "Cybersecurity in Digital Transformation - Challenges & Solutions",
                "max_participants" => 500
            ],
            (object)[
                "title" => "Cloud computing - Potential for enhancing business operations",
                "max_participants" => 500
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
