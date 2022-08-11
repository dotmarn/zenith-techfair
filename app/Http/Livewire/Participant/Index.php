<?php

namespace App\Http\Livewire\Participant;

use Livewire\Component;
use App\Facade\AppUtils;
use App\Models\SuperSession;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\ValidationException;

class Index extends Component
{
    use LivewireAlert;
    public $super_sessions, $firstname, $lastname, $email, $phone, $gender, $account_number, $have_an_account, $job_function, $industry_type, $area_of_responsibility, $selectedInterests = [], $class_session = [];

    public bool $show_account_section = false;

    public $job_functions, $area_of_interests, $industries;

    public function mount()
    {
        $this->job_functions = AppUtils::jobFunctionsData();
        $this->area_of_interests = AppUtils::areaOfInterestsData();
        $this->industries = AppUtils::industriesData();
        $this->super_sessions = SuperSession::select('id', 'title', 'description', 'max_participants')->get();
    }

    public function render()
    {
        return view('livewire.participant.index')->extends('layouts.app')->section('content');
    }

    public function verifyAccount()
    {
    }

    public function updatedHaveAnAccount($value)
    {
        if (empty($value) || $value == "") {
            $this->show_account_section = false;
            throw ValidationException::withMessages([
                'have_an_account' => "Please choose from the option"
            ]);
        } else if ($value == "yes") {
            $this->show_account_section = true;
            $this->clearErrorMessage(key: "have_an_account");
        } else {
            $this->show_account_section = false;
            $this->clearErrorMessage(key: "have_an_account");
        }
    }

    public function bookSummit()
    {
        $have_an_account_rule = ($this->have_an_account == "yes") ? ['required', 'numeric', 'digits:10'] : ['nullable'];

        $this->validate([
            'firstname' => ['required', 'string', 'min:3'],
            'lastname' => ['required', 'string', 'min:3'],
            'email' => ['required', 'string', 'email'],
            'job_function' => ['required', 'string', Rule::in($this->job_functions)],
            'phone' => ['required', 'numeric', 'digits:11'],
            'gender' => ['required', 'string'],
            'have_an_account' => ['required', Rule::in(['yes', 'no'])],
            'account_number' => $have_an_account_rule,
            'industry_type' => ['required', 'string', Rule::in($this->industries)],
            'area_of_responsibility' => ['required', 'string'],
            'selectedInterests' => ['required', 'array']
        ], [
            'have_an_account.required' => "This field is required",
            'selectedInterests.required' => "This field is required"
        ]);

        if (count($this->class_session) > 0) {
            $this->alert('success', 'Basic Alert');
        } else {
            $this->alert('error', 'Got heree');
        }

    }

    private function clearErrorMessage(string $key)
    {
        throw ValidationException::withMessages([
            $key => ""
        ]);
    }
}
