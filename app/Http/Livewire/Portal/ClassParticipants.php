<?php

namespace App\Http\Livewire\Portal;

use App\Models\SuperSession;
use Livewire\Component;

class ClassParticipants extends Component
{
    public $param;

    public function mount($id)
    {
        $this->param = $id;
    }

    public function render()
    {
        return view('livewire.portal.class-participants', [
            'item' => SuperSession::where('id', $this->param)->first()
        ])->extends('layouts.portal.dashboard')->section('content');
    }
}
