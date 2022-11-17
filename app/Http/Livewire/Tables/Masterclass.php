<?php

namespace App\Http\Livewire\Tables;

use App\Models\SuperSession;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Masterclass extends LivewireDatatable
{
    public function builder()
    {
        return SuperSession::query()->with('registrations');
    }

    public function columns()
    {
        return [
            Column::name('title')
            ->label('Title'),

            Column::name('registrations.id:count')
            ->label('Number Registered')
        ];
    }
}