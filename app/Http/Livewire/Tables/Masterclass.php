<?php

namespace App\Http\Livewire\Tables;

use App\Models\ClassRegistration;
use App\Models\SuperSession;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Masterclass extends LivewireDatatable
{
    public function builder()
    {
        return SuperSession::query()->leftJoin('class_registrations', 'class_registrations.super_session_id', 'super_sessions.id');
    }

    public function columns()
    {
        return [
            Column::name('title')
                    ->label('Title'),
    
            Column::name('max_participants')
                    ->label('Maximum Participant'),

            Column::name('totals.super_session_id:count')
                    ->label('Number Registered')
        ];
    }

    public function getTotalsProperty() 
    {
        ClassRegistration::all();
    }
}