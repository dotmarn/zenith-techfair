<?php

namespace App\Http\Livewire\Portal;

use App\Models\VerificationCode;
use Livewire\Component;

class View extends Component
{
    public $details;

    public function mount($token)
    {
        $this->details = VerificationCode::with('class_reg.masterclass')->where('token', $token)->first();
        abort_if(!$this->details, 404);
    }

    public function render()
    {
        return view('livewire.portal.view')->extends('layouts.portal.dashboard')->section('content');
    }
}
