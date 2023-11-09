<?php

namespace App\Http\Livewire\Tables;

use App\Models\Attendance;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Masterclass extends LivewireDatatable
{
    public $exportable = true;
    public $complex = false;
    public $persistComplexQuery = true;

    protected $listeners = [
        'dayChanged' => 'refreshAttendancesTable'
    ];

    public function refreshAttendancesTable($param)
    {
        $this->params = $param;
        $this->refreshLivewireDatatable();
    }

    public function builder()
    {
        return Attendance::query()->leftJoin('registrations', 'registrations.id', 'attendances.registration_id')
        ->where('attendances.event_date', $this->params)->whereNotNull('attendances.admitted_at');
    }

    public function columns()
    {
        return [
            Column::raw("CONCAT(registrations.firstname, ' ', registrations.lastname,' ', registrations.middlename) AS name")
            ->defaultSort('asc')
            ->label('Name'),

            Column::raw("registrations.email")
                    ->label('Email')
                    ->searchable(),

            Column::callback(['attendances.event_date'], function ($date) {
                return $date == "2023-11-22" ? 'Day 1' : 'Day 2';
            })->unsortable()->label('Event Day'),

            DateColumn::raw('attendances.admitted_at')
                ->label('Time Checked In')
                ->format('j F, Y H:s:i a')
        ];
    }
}
