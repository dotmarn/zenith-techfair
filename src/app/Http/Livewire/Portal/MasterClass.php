<?php

namespace App\Http\Livewire\Portal;

use App\Models\SuperSession;
use Livewire\Component;

class MasterClass extends Component
{
    public function render()
    {
        return view('livewire.portal.master-class', [
            'super_sessions' => SuperSession::select('id', 'title', 'max_participants', 'description')->withCount('registrations')->get()
        ])->extends('layouts.portal.dashboard')->section('content');
    }

}
