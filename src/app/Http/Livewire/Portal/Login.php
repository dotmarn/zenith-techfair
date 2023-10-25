<?php

namespace App\Http\Livewire\Portal;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Login extends Component
{
    use LivewireAlert;
    public $username, $password;

    public function render()
    {
        return view('livewire.portal.login')->extends('layouts.portal.auth')->section('content');
    }

    public function authenticateUser()
    {
        $this->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
            $user = Auth::user();
            $user->last_login = now();
            $user->update();
            return redirect()->to(route('portal.dashboard'));
        } else {
            $this->alert('error', 'Username or Password is incorrect...');
        }
    }
}
