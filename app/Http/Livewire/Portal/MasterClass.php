<?php

namespace App\Http\Livewire\Portal;

use App\Models\SuperSession;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class MasterClass extends Component
{
    use LivewireAlert;
    public $super_sessions, $title, $needed_participants, $description;

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

    public function createNew()
    {
        $this->validate([
            'title' => ['required', 'string', 'unique:super_sessions,title'],
            'needed_participants' => ['required', 'numeric', 'digits:2'],
            'description' => ['nullable', 'string']
        ]);

        SuperSession::create([
            'title' => $this->title,
            'max_participants' => $this->needed_participants,
            'description' => $this->description
        ]);

        return $this->alert('success', 'Master class session created successfully');
    }
}
