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
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\ValidationException;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    use LivewireAlert;
    public $super_sessions, $firstname, $lastname, $middlename, $email, $phone, $job_function, $account_number, $have_an_account, $sector, $interests = [], $qr_code_url, $reason;

    public $step_one = true, $step_two = false, $final_step = false;

    public $job_functions, $area_of_interests, $sectors;

    public $inputs = [], $class_session_inputs = [], $i = 1, $s = 0, $platform, $handle, $c_session, $event_date, $event_time;

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
        $header = array(
            "Content-type: text/xml",
            "SOAPAction: http://zenithbank.com/acctenquiry/GetAccountDetails"
        );

        $url = "https://newwebservicetest.zenithbank.com:8443/ZenithAcctEnquiry/acctenquiry.asmx?op=GetAccountDetails";
        $username = config('services.zenith.username');
        $password = config('services.zenith.password');

        $payload = "<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'><soap:Body><GetAccountDetails xmlns='http://zenithbank.com/acctenquiry/'><Username>{$username}</Username><Password>{$password}</Password><AccountNo>{$this->account_number}</AccountNo></GetAccountDetails></soap:Body></soap:Envelope>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $data = curl_exec($ch);
        $err = curl_error($ch);
        if ($err) {
            return $this->alert('error', 'Whoops!!! Unable to verify account number this time. Please try again');
        }

        $result_array = xml_to_array($data, false);
        //convert xml response to array
        $result_data = $result_array['soap:Body']['GetAccountDetailsResponse']['GetAccountDetailsResult'];
        if ($result_data['ResponseCode'] == "00") {
            $account_name = explode(" ", $result_data['AccountName']);
            $this->firstname = $account_name[0];
            $this->lastname = $account_name[1];
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
            throw ValidationException::withMessages([
                'have_an_account' => "Please choose from the option"
            ]);
        } else if ($value == "yes") {
            $this->clearErrorMessage(key: "have_an_account");
        } else {
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
            'job_function' => ['nullable', 'string', Rule::in($this->job_functions)],
            'sector' => ['nullable', 'string', Rule::in($this->sectors)]
        ]);

        DB::transaction(function () {
            $token = "ZEN-" . Str::random(5) . "-" . mt_rand(1000, 9999);

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

            $duplicate_event_time = collect($this->event_time)->duplicates();
            if ($duplicate_event_time->isNotEmpty()) {
                return $this->alert('error', 'You can only attend one event at the specified time');
            }

            // $last_reg = DB::table('registrations')->select('id')->latest()->first();

            $uuid = Str::uuid();

            $registration = Registration::create([
                'reg_uuid' => $uuid,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'middlename' => $this->middlename,
                'email' => $this->email,
                'role' => $this->job_function,
                'phone' => $this->phone,
                'sector' => $this->sector,
                'have_an_account' => $this->have_an_account,
                'account_number' => $this->account_number,
                'reason' => $this->reason,
                'interests' => $this->interests,
                'social_media' => $social_media ?? []
            ]);

            $image = \QrCode::size(500)->format('png')->generate(route('portal.view-registration', $token));

            $base64 = "data:image/png;base64," . base64_encode($image);
            $this->qr_code_url = Cloudinary::upload($base64)->getSecurePath();

            $last_ver = DB::table('verification_codes')->select('id')->latest()->first();

            VerificationCode::create([
                'reg_uuid' => $uuid,
                'registration_id' => $registration->id,
                'qrcode_url' => $this->qr_code_url,
                'token' => $token
            ]);

            $event_data = [
                (object) [
                    "label" => "Day 1",
                    "date" => "2022-11-22"
                ],
                (object) [
                    "label" => "Day 2",
                    "date" => "2022-11-23"
                ]
            ];

            foreach ($event_data as $key => $ev) {
                // $last_att = DB::table('attendances')->select('id')->latest()->first();
                Attendance::create([
                    'reg_uuid' => $uuid,
                    'registration_id' => $registration->id,
                    'event_label' => $ev->label,
                    'event_date' => $ev->date
                ]);
            }

            if (count($this->c_session ?? []) > 0) {
                $classes = ClassRegistration::select('registration_id', 'super_session_id')->whereIn('super_session_id', $this->c_session)->get();
                foreach ($this->c_session as $key => $session) {
                    // $last_class = DB::table('class_registrations')->select('id')->latest()->first();
                    $count = collect($classes)->where('super_session_id', $session)->count();
                    $session_details = collect($this->super_sessions)->where('id', $session)->first();
                    if ($count < $session_details->max_participants) {
                        $registration->super_session()->create([
                            'reg_uuid' => $uuid,
                            'super_session_id' => $session,
                            'preferred_date' => $this->event_date[$key],
                            'preferred_time' => $this->event_time[$key]
                        ]);
                    }
                }
            }

            $body = "<p style='text-align:center; font-weight:bold'>Thank you,  {$this->firstname} {$this->lastname}</p>";
            $body .= "<p style='text-align:center;'>You are all signed up for <b>The Zenith Tech Fair 2022</b></p>";
            $body .= "<p style='text-align:center; font-weight:bold'>Theme: FUTURE FORWARD 2.0</p>";
            $body .= "<p><b>Address: </b>Eko Hotels, Plot 1415 Adetokunbo Ademola Street, Victoria Island, Lagos.</p>";
            $body .= "<p><b>Date: </b>22nd and 23rd November 2022</p>";
            $body .= "<p><b>Time: </b>8am to 6pm</p>";
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
