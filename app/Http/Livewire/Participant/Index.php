<?php

namespace App\Http\Livewire\Participant;

use Livewire\Component;
use App\Facade\AppUtils;
use App\Models\Attendance;
use Illuminate\Support\Str;
use App\Models\Registration;
use App\Models\SuperSession;
use Illuminate\Validation\Rule;
use App\Models\VerificationCode;
use App\Models\ClassRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralNotificationMail;
use App\Services\AccountVerificationService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\ValidationException;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    use LivewireAlert;

    public $super_sessions, $firstname, $lastname, $middlename, $email, $phone, $job_function, $account_number, $have_an_account, $sector, $interests = [], $reason;

    public $step_one = true, $step_two = false, $final_step = false, $success = false;

    public $job_functions, $area_of_interests, $sectors, $consent;

    public $inputs = [], $class_session_inputs = [], $i = 0, $s = 0, $platform, $handle, $c_session, $event_date, $event_time;

    public $events_date = [], $events_time = [];

    protected $listeners = [
        'class_selected'
    ];

    public function mount()
    {
        $this->job_functions = AppUtils::jobFunctionsData();
        $this->area_of_interests = AppUtils::areaOfInterestsData();
        $this->sectors = AppUtils::sectorsData();
        $this->super_sessions = SuperSession::select('id', 'title', 'max_participants', 'event_date', 'event_time')->get();
    }

    public function class_selected($data)
    {
        $selected_date = $this->event_date;
        $selected_time = $this->event_time;
        if (!empty($data) || $data != "") {

            $session = collect($this->super_sessions)->where('id', $data)->first();

            if (count($selected_date ?? []) > 0) {
                foreach ($selected_date as $key => $value) {
                    $this->event_date[$key] = $value;
                }
            }

            if (count($selected_time ?? []) > 0) {
                foreach ($selected_time as $key => $value) {
                    $this->event_time[$key] = $value;
                }
            }

            // merge result

            $this->events_date = collect(array_merge($this->event_date ?? [], $session->event_date))->unique();
            $this->events_time = collect(array_merge($this->event_time ?? [], $session->event_time))->unique();
        }
    }

    public function render()
    {
        return view('livewire.participant.index')->extends('layouts.app')->section('content');
    }

    public function verifyAccount()
    {
        if (!$this->account_number) {
            return $this->alert('error', 'Enter your zenith account number');
        }

        $response = (new AccountVerificationService())->verifyAccountNumber($this->account_number);

        if (is_string($response)) {
            return $this->alert('error', $response);
        }

        if (!isset($response['soap:Body']['GetAccountDetailsResponse']['GetAccountDetailsResult'])) {
            $this->alert('error', 'Account verification could not be completed at this time.');
            return;
        }

        $result_data = $response['soap:Body']['GetAccountDetailsResponse']['GetAccountDetailsResult'];
        if ($result_data['ResponseCode'] == "00") {
            $account_name = explode(" ", $result_data['AccountName']);
            $this->firstname = $account_name[0] ?? "";
            $this->lastname = $account_name[1] ?? "";
            $this->middlename = (count($account_name) == 3) ? $account_name[2] : '';
        } else {
            return $this->alert('error', $result_data['ResponseMessage']);
        }
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
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
        $this->i -= 1;
        unset($this->inputs[$i - 1]);
        unset($this->platform[$i]);
        unset($this->handle[$i]);
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
            throw ValidationException::withMessages([
                'have_an_account' => "Please choose from the option"
            ]);
        } else if ($value == "yes") {
            $this->resetValidation("have_an_account");
        } else {
            $this->resetValidation("have_an_account");
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
            'phone' => ['required', 'unique:registrations,phone'],
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
        $have_an_account_rule = ($this->have_an_account == "yes") ? ['required', 'numeric', 'digits:10'] : ['nullable'];

        $this->validate([
            'firstname' => ['required', 'string', 'min:3'],
            'lastname' => ['required', 'string', 'min:3'],
            'middlename' => ['nullable', 'string', 'min:3'],
            'email' => ['required', 'string', 'email', 'unique:registrations,email'],
            'phone' => ['required', 'unique:registrations,phone'],
            'have_an_account' => ['required', Rule::in(['yes', 'no'])],
            'account_number' => $have_an_account_rule,
            'reason' => ['required', 'string', Rule::in(AppUtils::acceptedReasons())],
            'job_function' => ['nullable', 'string', Rule::in($this->job_functions)],
            'sector' => ['nullable', 'string', Rule::in($this->sectors)],
            'consent' => ['required', 'string']
        ], [
            'have_an_account.required' => "This field is required",
        ]);

        $this->sanitize();

        $is_exist = Registration::where(function ($query) {
            $query->where('email', $this->email)
                ->orWhere('phone', $this->phone);
        })->first();

        if ($is_exist) {
            return $this->alert('error', 'Record already exists', [
                'toast' => false,
                'position' => 'center',
                'timer' => 5000
            ]);
        }

        // if (count($this->platform ?? []) !== count($this->handle ?? [])) {
        //     return $this->alert('error', 'Please fill all the required field(s)');
        // }

        // if (in_array("", $this->platform ?? []) || in_array("", $this->handle ?? [])) {
        //     return $this->alert('error', 'Please fill all the required field(s)');
        // }

        if (count($this->platform ?? []) < count($this->handle ?? [])) {
            return $this->alert('error', 'One or more social media platform is misssing.');
        }

        $duplicates = collect($this->platform)->duplicates();
        if ($duplicates->isNotEmpty()) {
            return $this->alert('error', 'Platform field contains one or more duplicates');
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
        $d_dup = collect($this->event_date)->duplicates();
        $duplicate_event_time = collect($this->event_time)->duplicates();

        if ($c_dup->isNotEmpty() && $d_dup->isNotEmpty()) {
            return $this->alert('error', 'You cannot the same session on the same day.');
        }

        if ($d_dup->isNotEmpty()) {
            return $this->alert('error', 'You can only attend one event per day');
        }

        if ($duplicate_event_time->isNotEmpty() && $d_dup->isNotEmpty()) {
            return $this->alert('error', 'You can only attend one event on each days.');
        }

        if (count($this->platform ?? []) > 0) {
            $handles = [];
            foreach ($this->platform as $key => $value) {
                $handle = $this->handle[$key] ?? "";
                $handles[] = $this->cleanInput($handle);
            }
            $social_media = array_combine($this->platform, $handles);
        }

        DB::transaction(function () use (&$social_media) {
            $token = "ZEN-" . Str::random(5) . "-" . mt_rand(1000, 9999);

            $registration = Registration::create([
                'firstname' => trim($this->firstname),
                'lastname' => trim($this->lastname),
                'middlename' => trim($this->middlename),
                'email' => trim($this->email),
                'role' => $this->job_function,
                'phone' => $this->phone,
                'sector' => $this->sector,
                'have_an_account' => $this->have_an_account,
                'account_number' => $this->account_number,
                'reason' => $this->reason,
                'interests' => $this->interests,
                'social_media' => $social_media ?? [],
                'consent' => $this->consent
            ]);

            $image = \QrCode::size(500)->format('png')->generate(route('portal.view-registration', $token));

            $base64 = "data:image/png;base64," . base64_encode($image);
            $qr_code_url = Cloudinary::upload($base64)->getSecurePath();

            VerificationCode::create([
                'registration_id' => $registration->id,
                'qrcode_url' => $qr_code_url,
                'token' => $token
            ]);

            $event_data = [
                (object) [
                    "label" => "Day 1",
                    "date" => "2023-11-22"
                ],
                (object) [
                    "label" => "Day 2",
                    "date" => "2023-11-23"
                ]
            ];

            foreach ($event_data as $key => $ev) {
                Attendance::create([
                    'registration_id' => $registration->id,
                    'event_label' => $ev->label,
                    'event_date' => $ev->date
                ]);
            }

            // if (count($this->c_session ?? []) > 0) {
            //     $classes = ClassRegistration::select('registration_id', 'super_session_id')->whereIn('super_session_id', $this->c_session)->get();
            //     foreach ($this->c_session as $key => $session) {
            //         $count = collect($classes)->where('super_session_id', $session)->count();
            //         $session_details = collect($this->super_sessions)->where('id', $session)->first();
            //         if ($count < $session_details->max_participants) {
            //             $registration->super_session()->create([
            //                 'super_session_id' => $session,
            //                 'preferred_date' => $this->event_date[$key],
            //                 'preferred_time' => $this->event_time[$key]
            //             ]);
            //         } else {

            //             DB::rollBack();
            //             return $this->alert('info', "{$session_details->title} has been filled already.", [
            //                 'toast' => false,
            //                 'timer' => 5000,
            //                 'position' => 'center'
            //             ]);
            //         }
            //     }
            // }

            $body = "<p style='text-align:center; font-weight:bold'>Thank you,  {$this->firstname} {$this->lastname}</p>";
            $body .= "<p style='text-align:center;'>You are all signed up for <b>The Zenith Tech Fair 2023</b></p>";
            $body .= "<p style='text-align:center; font-weight:bold'>Theme: FUTURE FORWARD 3.0</p>";
            $body .= "<p><b>Address: </b>Eko Hotels, Plot 1415 Adetokunbo Ademola Street, Victoria Island, Lagos.</p>";
            $body .= "<p><b>Date: </b>22nd and 23rd November 2023</p>";
            $body .= "<p><b>Time: </b>9am to 6pm</p>";
            $body .= "<div style='text-align:center'><img src='{$qr_code_url}' style='width:50%' /></div>";

            $payload = [
                'username' => $this->firstname,
                'email' => $this->email,
                'subject' => "{$this->firstname}, thank you for registering for the event",
                'body' => $body
            ];

            try {
                Mail::to($this->email)->send(new GeneralNotificationMail(
                    json_encode($payload)
                ));
            } catch (\Exception $e) {
                DB::rollback();
                info("Mail Sending Error:".json_encode($e->getMessage()));
            }

            $this->success = true;

        });
    }

    protected function sanitize(): void
    {
        $this->firstname = filter_var($this->firstname, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $this->lastname = filter_var($this->lastname, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $this->middlename = filter_var($this->middlename, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    }

    protected function cleanInput(string $input) : string
    {
        return filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    }
}
