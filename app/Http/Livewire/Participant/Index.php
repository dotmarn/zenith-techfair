<?php

namespace App\Http\Livewire\Participant;

use Livewire\Component;
use App\Facade\AppUtils;
use Illuminate\Support\Str;
use App\Models\Registration;
use App\Models\SuperSession;
use Illuminate\Validation\Rule;
use App\Models\VerificationCode;
use App\Models\ClassRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralNotificationMail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\ValidationException;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    use LivewireAlert;
    public $super_sessions, $firstname, $lastname, $middlename, $email, $phone, $role, $account_number, $have_an_account, $sector, $interests = [], $qr_code_url, $reason;

    public bool $show_account_section = false;
    public $step_one = true, $step_two = false, $final_step = false;

    public $roles, $area_of_interests, $sectors;

    public $inputs = [], $class_session_inputs = [], $i = 1, $s = 0, $platform, $handle, $c_session, $event_date, $event_time;

    public function mount()
    {
        $this->roles = AppUtils::roles();
        $this->area_of_interests = AppUtils::areaOfInterestsData();
        $this->sectors = AppUtils::sectorsData();
        $this->super_sessions = SuperSession::select('id', 'title', 'max_participants', 'event_date', 'event_time')->get();
    }

    public function render()
    {
        return view('livewire.participant.index')->extends('layouts.app')->section('content');
    }

    public function verifyAccount()
    {
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function addMore($i)
    {
        if (count($this->class_session_inputs) < 1) {
            $i = $i + 1;
            $this->s = $i;
            array_push($this->class_session_inputs, $i);
        }
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function delete($i)
    {
        $this->s -= 1;
        unset($this->class_session_inputs[$i - 1]);
        unset($this->c_session[$i]);
        unset($this->event_date[$i]);
        unset($this->event_time[$i]);
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
            'middlename' => ['nullable', 'string', 'min:3'],
            'email' => ['required', 'string', 'email', 'unique:registrations,email'],
            'phone' => ['required', 'numeric', 'digits:11', 'unique:registrations,phone'],
            'have_an_account' => ['required', Rule::in(['yes', 'no'])],
            'account_number' => $have_an_account_rule
        ], [
            'have_an_account.required' => "This field is required",
        ]);

        if (count($this->platform ?? []) !== count($this->handle ?? [])) {
            return $this->alert('error', 'Please fill all the required field(s)');
        }

        if (in_array("", $this->platform ?? []) || in_array("", $this->handle ?? [])) {
            return $this->alert('error', 'Please fill all the required field(s)');
        }

        $duplicates = collect($this->platform)->duplicates();
        if ($duplicates->isNotEmpty()) {
            return $this->alert('error', 'Platform field contains one or more duplicates');
        }

        $this->step_two = true;
        $this->step_one = false;
    }

    public function bookSummit()
    {
        $this->validate([
            'reason' => ['required', 'string', Rule::in(AppUtils::acceptedReasons())],
            'role' => ['nullable', 'string', Rule::in($this->roles)],
            'sector' => ['nullable', 'string', Rule::in($this->sectors)]
        ]);

        DB::transaction(function () {
            $token = "ZEN-".Str::random(5)."-".mt_rand(1000, 9999);

            if (count($this->platform ?? []) > 0) {
                $social_media = array_combine($this->platform, $this->handle);
            }

            if (is_null($this->c_session) && (!is_null($this->event_date) || !is_null($this->event_time))) {
                return $this->alert('error', 'Please fill all the required field(s)');
            }

            if (is_null($this->event_date) && (!is_null($this->c_session) || !is_null($this->event_time))) {
                return $this->alert('error', 'Please fill all the required field(s)');
            }

            if (is_null($this->event_time) && (!is_null($this->c_session) || !is_null($this->event_date))) {
                return $this->alert('error', 'Please fill all the required field(s)');
            }

            if (in_array("", $this->c_session ?? []) || in_array("", $this->event_date ?? []) || in_array("", $this->event_time ?? [])) {
                return $this->alert('error', 'Please fill all the required field(s)');
            }

            if (
                count($this->c_session ?? []) > 0 &&
                (count($this->event_date ?? []) !== count($this->c_session ?? [])) ||
                (count($this->event_time ?? []) !== count($this->c_session ?? []))
            ) {
                return $this->alert('error', 'Please fill all the required field(s)');
            }

            $c_dup = collect($this->c_session)->duplicates();
            if ($c_dup->isNotEmpty()) {
                return $this->alert('error', 'Master class contains one or more duplicates');
            }

            $d_dup = collect($this->event_date)->duplicates();
            if ($d_dup->isNotEmpty()) {
                return $this->alert('error', 'You can only attend one event per day');
            }

            $registration = Registration::create([
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'middlename' => $this->middlename,
                'email' => $this->email,
                'role' => $this->role,
                'phone' => $this->phone,
                'sector' => $this->sector,
                'have_an_account' => $this->have_an_account,
                'account_number' => $this->account_number,
                'reason' => $this->reason,
                'interests' => $this->interests,
                'social_media' => $social_media ?? []
            ]);

            $image = \QrCode::size(500)->format('png')->generate(route('portal.view-registration', $token));

            $base64 = "data:image/png;base64,".base64_encode($image);
            $this->qr_code_url = Cloudinary::upload($base64)->getSecurePath();

            VerificationCode::create([
                'registration_id' => $registration->id,
                'qrcode_url' => $this->qr_code_url,
                'token' => $token
            ]);

            $body = "<p>Thank you for registering for the Zenith Tech Fair.</p>";
            $body .= "<div style='text-align:center'><img src='{$this->qr_code_url}' style='width:50%' /></div>";

            $payload = [
                'username' => $this->firstname,
                'email' => $this->email,
                'subject' => "{$this->firstname}, thank you for registering for the event",
                'body' => $body
            ];

            $payload = json_encode($payload);

            try {
                Mail::to($this->email)->send(new GeneralNotificationMail($payload));
            } catch (\Exception $e) {
                \Log::info($e->getMessage());
            }

            if (count($this->c_session ?? []) > 0 ) {
                $classes = ClassRegistration::select('registration_id', 'super_session_id')->whereIn('super_session_id', $this->c_session)->get();
                foreach ($this->c_session as $key => $session) {
                    $count = collect($classes)->where('super_session_id', $session)->count();
                    $session_details = collect($this->super_sessions)->where('id', $session)->first();
                    if ($count < $session_details->max_participants) {
                        $registration->super_session()->create([
                            'super_session_id' => $session,
                            'preferred_date' => $this->event_date[$key],
                            'preferred_time' => $this->event_time[$key]
                        ]);
                    }
                }
            }

            $this->alert('success', 'Registration successful.');

            $this->step_two = false;
            $this->final_step = true;

        });

    }

    private function clearErrorMessage(string $key)
    {
        throw ValidationException::withMessages([
            $key => ""
        ]);
    }
}
