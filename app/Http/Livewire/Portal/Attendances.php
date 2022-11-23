<?php

namespace App\Http\Livewire\Portal;

use Livewire\Component;

class Attendances extends Component
{
    public $param;

    public function mount($id = null)
    {
        $this->param = $id;
    }

    public function render()
    {
        return view('livewire.portal.attendances')->extends('layouts.portal.dashboard')->section('content');
    }

}
