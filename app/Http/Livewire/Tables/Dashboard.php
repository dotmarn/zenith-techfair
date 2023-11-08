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
        return Registration::query()->leftJoin('verification_codes', 'verification_codes.registration_id', 'registrations.id');
    }

    public function columns()
    {
        return [

            Column::callback(['firstname', 'lastname', 'middlename', 'verification_codes.token'], function($firstname, $lastname, $middlename, $token) {
                return '<a style="text-decoration:underline;" class="text-blue-500" href="'.route("portal.view-registration", $token).'">'.$lastname." ".$firstname." ".$middlename.'</a>';
            })->exportCallback(function ($firstname, $lastname, $middlename) {
                return $lastname." ".$firstname." ".$middlename;
            })->unwrap()->label('Name'),

            Column::name('email')
                ->label('Email'),

            Column::name('phone')
                ->label('Phone'),

            Column::name('account_number')
                ->label('Account Number'),

            Column::name('role')
                ->label('Role')->unwrap(),

            Column::name('sector')
                ->label('Sector')->unwrap(),

            Column::name('reason')
                ->label('Reason for attending')->unwrap(),

            Column::callback(['status'], function ($status) {
                return $status == 'verified' ?
                '<div class="flex items-center"><i class="fas fa-square text-[#6dd400]"></i><label for="" class="ml-2">'. ucfirst($status) .'</label></div>' :
                '<div class="flex items-center"><i class="fas fa-square text-red-600"></i><label for="" class="ml-2">'. ucfirst($status) .'</label></div>';
            })->excludeFromExport()->unsortable()->label('Status'),

            Column::callback(['consent'], function($consent) {
                return ucfirst($consent);
            })->label('Consent'),

            DateColumn::raw('registrations.created_at')
                ->label('Date Registered')
                ->format('j F, Y H:i a')->unwrap()->defaultSort('desc'),

            Column::callback(['verification_codes.token'], function ($token) {
                return view('table-actions', ['token' => $token]);
            })->excludeFromExport()->unsortable()->label('Action')

        ];
    }
}
