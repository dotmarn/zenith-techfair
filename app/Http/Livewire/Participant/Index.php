<?php

namespace App\Http\Livewire\Participant;

use Livewire\Component;
use App\Facade\AppUtils;
use Illuminate\Support\Str;
use App\Models\Registration;
use App\Models\SuperSession;
use Illuminate\Validation\Rule;
use App\Models\VerificationCode;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\ValidationException;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    use LivewireAlert;
    public $super_sessions, $firstname, $lastname, $email, $phone, $role, $account_number, $have_an_account, $sector, $selectedInterests = [], $class_session = [], $qr_code_url, $reason;

    public bool $show_account_section = false;
    public $step_one = true, $step_two = false, $final_step = false;

    public $roles, $area_of_interests, $sectors;

    public function mount()
    {
        $this->roles = AppUtils::roles();
        $this->area_of_interests = AppUtils::areaOfInterestsData();
        $this->sectors = AppUtils::sectorsData();
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

    public function goBack()
    {
        $this->step_two = false;
        $this->step_one = true;
    }

    public function nextStepLogic()
    {
        $have_an_account_rule = ($this->have_an_account == "yes") ? ['required', 'numeric', 'digits:10'] : ['nullable'];

        $this->validate([
            'firstname' => ['required', 'string', 'min:3'],
            'lastname' => ['required', 'string', 'min:3'],
            'email' => ['required', 'string', 'email', 'unique:registrations,email'],
            'role' => ['nullable', 'string', Rule::in($this->roles)],
            'phone' => ['required', 'numeric', 'digits:11', 'unique:registrations,phone'],
            'have_an_account' => ['required', Rule::in(['yes', 'no'])],
            'account_number' => $have_an_account_rule,
            'sector' => ['nullable', 'string', Rule::in($this->sectors)]
        ], [
            'have_an_account.required' => "This field is required"
        ]);

        $this->step_two = true;
        $this->step_one = false;
    }

    public function bookSummit()
    {

        $this->validate([
            'selectedInterests' => ['required', 'array'],
            'reason' => ['required', 'string', Rule::in(AppUtils::acceptedReasons())]
        ], [
            'selectedInterests.required' => "This field is required"
        ]);

        // $token = "ZEN-".Str::random(5)."-".mt_rand(1000, 9999);

        // $registration = Registration::create([
        //     'firstname' => $this->firstname,
        //     'lastname' => $this->lastname,
        //     'email' => $this->email,
        //     'role' => $this->role,
        //     'phone' => $this->phone,
        //     'sector' => $this->sector,
        //     'have_an_account' => $this->have_an_account,
        //     'account_number' => $this->account_number,
        //     'reason' => $this->reason,
        //     'interests' => json_encode($this->selectedInterests)
        // ]);

        // $image = \QrCode::size(500)->format('png')->generate(config('app.url').$token);

        // $base64 = "data:image/png;base64,".base64_encode($image);
        // $this->qr_code_url = Cloudinary::upload($base64)->getSecurePath();

        // VerificationCode::create([
        //     'registration_id' => $registration->id,
        //     'qrcode_url' => $this->qr_code_url,
        //     'token' => $token
        // ]);

        // $this->step_two = false;
        // $this->final_step = true;

        // if (count($this->class_session) > 0) {
        //     $this->alert('success', 'Basic Alert');
        // } else {
        //     $this->alert('error', 'Got heree');
        // }

    }

    private function clearErrorMessage(string $key)
    {
        throw ValidationException::withMessages([
            $key => ""
        ]);
    }
}
