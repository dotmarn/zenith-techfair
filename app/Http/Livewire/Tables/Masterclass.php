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
        return SuperSession::query();
    }

    public function columns()
    {
        return [
            Column::name('title')
                    ->label('Title'),
    
            Column::name('max_participants')
                    ->label('Maximum Participant'),
        ];
    }

    public function getTotalsProperty()
    {
        return ClassRegistration::all();
    }

}