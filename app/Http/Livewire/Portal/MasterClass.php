<?php

namespace App\Http\Livewire\Portal;

use App\Models\SuperSession;
use Livewire\Component;

class MasterClass extends Component
{
    public $super_sessions;

    protected $listeners = [
        'deleteConfirmed',
        'cancelled',
        'edit_data_updated'
    ];

    public function render()
    {
        $this->super_sessions = SuperSession::select('id', 'title', 'max_participants', 'description')->withCount('registrations')->get();
        return view('livewire.portal.master-class')->extends('layouts.portal.dashboard')->section('content');
    }
}
