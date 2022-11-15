<?php

namespace App\Http\Livewire\Tables;

use App\Models\Registration;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Dashboard extends LivewireDatatable
{
    public $hideable = false;
    public $exportable = true;
    public $complex = false;
    public $persistComplexQuery = true;

    public function builder()
    {
        return Registration::query()->leftJoin('verification_codes', 'verification_codes.reg_uuid', 'registrations.reg_uuid');
    }

    public function columns()
    {
        return [
            Column::raw("CONCAT(registrations.firstname, ' ', registrations.lastname,' ', registrations.middlename) AS name")
                ->defaultSort('asc')
                ->label('Name'),

            Column::name('email')
                ->label('Email'),

            Column::name('phone')
                ->label('Phone'),

            Column::name('account_number')
                ->label('Account Number'),

            Column::name('role')
                ->label('Role'),

            Column::name('sector')
                ->label('Sector'),

            Column::name('reason')
                ->label('Reason for attending'),

            Column::name('status')
                ->label('Status'),

            DateColumn::raw('registrations.created_at')
                ->label('Date Registered')
                ->format('j F, Y H:i a'),

            Column::callback(['verification_codes.token'], function ($token) {
                return view('table-actions', ['token' => $token]);
            })->unsortable()->excludeFromExport()->unsortable()->label('Action')

        ];
    }
}
