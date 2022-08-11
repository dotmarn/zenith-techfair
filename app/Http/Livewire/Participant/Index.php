<?php

namespace App\Http\Livewire\Participant;

use App\Models\SuperSession;
use Livewire\Component;

class Index extends Component
{
    public $super_sessions, $firstname, $lastname, $email, $phone, $gender, $account_number, $have_an_account;

    public function mount()
    {
       $this->super_sessions = SuperSession::select('id', 'title', 'description', 'max_participants')->get();
    }

    public function render()
    {
        return view('livewire.participant.index')->extends('layouts.app')->section('content');
    }

    public function verifyAccount()
    {

    }


}
