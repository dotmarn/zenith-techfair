<?php

namespace App\Http\Livewire\Portal;

use Livewire\Component;

class MasterClass extends Component
{
    public function render()
    {
        return view('livewire.portal.master-class')->extends('layouts.portal.dashboard')->section('content');
    }
}
