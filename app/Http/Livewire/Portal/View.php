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
            'attendance' => Attendance::where('registration_id', $this->details->reg_info->id)->get()
        ])->extends('layouts.portal.dashboard')->section('content');
    }

    public function checkIn($id)
    {
        ClassRegistration::where('id', $id)->update([
            'admitted_at' => now(),
            'status' => 'verified'
        ]);

        return $this->flash('success', 'Event participation verification successful.', [], url()->previous());
    }

    public function markPresent($id)
    {
        Attendance::where('id', $id)->update([
            'admitted_at' => now()
        ]);

        return $this->alert('success', 'Attendance marked successfully.');
    }
}
