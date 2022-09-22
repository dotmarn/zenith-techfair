<?php

namespace App\Http\Livewire\Portal;

use App\Models\ClassRegistration;
use App\Models\VerificationCode;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

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
        return view('livewire.portal.view')->extends('layouts.portal.dashboard')->section('content');
    }

    public function checkIn($id)
    {
        ClassRegistration::where('id', $id)->update([
            'admitted_at' => now(),
            'status' => 'verified'
        ]);

        return $this->flash('success', 'Event participation verification successful.', [], url()->previous());
    }
}
