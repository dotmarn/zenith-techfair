<?php

namespace App\Http\Livewire\Portal;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\VerificationCode;
use App\Models\ClassRegistration;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class View extends Component
{
    use LivewireAlert;
    public $details;

    public function mount($token)
    {
        $this->details = VerificationCode::with('reg_info.super_session.masterclass')->where('token', $token)->first();
        abort_if(!$this->details, 404);
    }

    public function render()
    {
        return view('livewire.portal.view', [
            'attendance' => Attendance::where('reg_uuid', $this->details->reg_info->reg_uuid)->orderBy('id', 'ASC')->get()
        ])->extends('layouts.portal.dashboard')->section('content');
    }

    public function checkIn($item)
    {
        ClassRegistration::where('super_session_id', $item['super_session_id'])->where('reg_uuid', $item['reg_uuid'])->update([
            'admitted_at' => now(),
            'status' => 'verified'
        ]);

        return $this->flash('success', 'Event participation verification successful.', [], url()->previous());
    }

    public function markPresent($item)
    {
        Attendance::where('reg_uuid', $item['reg_uuid'])->where('event_label', $item['event_label'])->update([
            'admitted_at' => now()
        ]);

        return $this->alert('success', 'Attendance marked successfully.');
    }
}
