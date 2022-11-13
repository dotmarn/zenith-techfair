<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\ClassRegistration;
use Illuminate\Support\Str;
use App\Models\Registration;
use App\Models\VerificationCode;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registrations = Registration::whereNull('reg_uuid')->select('id', 'reg_uuid')->chunkById(50, function($regs) {
            foreach ($regs as $key => $reg) {
                $uuid = Str::uuid();
                $reg->update(['reg_uuid' => $uuid]);

                Attendance::where('registration_id', $reg->id)->update([
                    'reg_uuid' => $uuid
                ]);

                ClassRegistration::where('registration_id', $reg->id)->update([
                    'reg_uuid' => $uuid
                ]);

                VerificationCode::where('registration_id', $reg->id)->update([
                    'reg_uuid' => $uuid
                ]);
            }
        });
    }
}
