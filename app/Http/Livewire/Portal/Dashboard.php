<?php

namespace App\Http\Livewire\Portal;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $registrations;

    public function mount()
    {
        $this->registrations = DB::table('registrations')->latest('id')->get();
    }

    public function render()
    {
        return view('livewire.portal.dashboard')->extends('layouts.portal.dashboard')->section('content');
    }
}
