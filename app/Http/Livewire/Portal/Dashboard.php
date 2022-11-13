<?php

namespace App\Http\Livewire\Portal;

use Livewire\Component;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $registrations;

    public function mount()
    {
        $this->registrations = Registration::select(
            'reg_uuid', 'firstname', 'lastname', 'middlename', 'email', 'role', 'phone', 'sector', 'account_number', 'reason', 'status', 'created_at'
        )->with('tokens:reg_uuid,token')->latest()->get();
    }

    public function render()
    {
        return view('livewire.portal.dashboard')->extends('layouts.portal.dashboard')->section('content');
    }
}
