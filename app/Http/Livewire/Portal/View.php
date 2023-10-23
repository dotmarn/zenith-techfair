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
            'attendance' => Attendance::where('registration_id', $this->details->reg_info->id)->orderBy('id', 'ASC')->get()
        ])->extends('layouts.portal.dashboard')->section('content');
    }

    public function checkIn($item)
    {
        ClassRegistration::where('super_session_id', $item['super_session_id'])->where('registration_id', $item['registration_id'])->update([
            'admitted_at' => now(),
            'status' => 'verified'
        ]);

        return $this->flash('success', 'Event participation verification successful.', [], route('portal.view-registration', $this->details->token));
    }

    public function markPresent($item)
    {
        Attendance::where('registration_id', $item['registration_id'])->where('event_label', $item['event_label'])->update([
            'admitted_at' => now()
        ]);

        return $this->alert('success', 'Attendance marked successfully.');
    }
}
