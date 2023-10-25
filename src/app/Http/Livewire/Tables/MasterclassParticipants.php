<?php

namespace App\Http\Livewire\Tables;

use App\Models\SuperSession;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class MasterclassParticipants extends LivewireDatatable
{
    public $exportable = true;
    public $complex = false;
    public $persistComplexQuery = true;

    public function builder()
    {
        return SuperSession::query()->leftJoin('class_registrations', 'class_registrations.super_session_id', 'super_sessions.id')
        ->leftJoin('registrations', 'registrations.id', 'class_registrations.registration_id')
        ->where('super_sessions.id', $this->params);
    }

    public function columns()
    {
        return [
            
            Column::raw("CONCAT(registrations.firstname, ' ', registrations.lastname,' ', registrations.middlename) AS name")
            ->defaultSort('asc')
            ->label('Name'),
            
            Column::raw("registrations.email")
                    ->label('Email'),

            DateColumn::raw('class_registrations.preferred_date')
                ->label('Date')
                ->format('j F, Y'),

            Column::name('class_registrations.preferred_time')
                    ->label('Time'),

            Column::callback(['class_registrations.status'], function ($status) {
                return $status == 'pending' ? 
                '<div class="flex items-center"><i class="fas fa-square text-red-600"></i><label for="" class="ml-2">'. ucfirst($status) .'</label></div>' :
                '<div class="flex items-center"><i class="fas fa-square text-[#6dd400]"></i><label for="" class="ml-2">'. ucfirst($status) .'</label></div>';
            })->excludeFromExport()->unsortable()->label('Status'),

            DateColumn::raw('class_registrations.admitted_at')
                ->label('Time Checked In')
                ->format('j F, Y')
        ];
    }
}