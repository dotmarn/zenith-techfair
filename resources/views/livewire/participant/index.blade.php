@section('title', 'Zenith Tech Fair::Welcome')
<div>
    @include('partials.participant.header')
    @if (!$success)
        <section class="w-full pt-12 md:pt-16 lg:pt-32">
            <div class="max-w-3xl mx-auto">
                <div class="grid grid-cols-1">
                    <div class="py-8 px-6 sm:px-8">
                        <form method="POST" wire:submit.prevent="bookSummit">
                            {{ csrf_field() }}
                            <div class="py-4">
                                <div class="space-y-5 mb-2">
                                    <div class="w-full">
                                        <label for="have_an_account"
                                            class="block font-semibold text-white mb-2 text-xs">Do
                                            you
                                            have a
                                            Zenith
                                            Bank
                                            account?
                                            <span class="text-red-400">*</span></label>
                                        <select wire:model.lazy="have_an_account" id="have_an_account"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#1F262C] text-xs lg:text-base font-Poppins font-semibold">
                                            <option value=""></option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        @error('have_an_account')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div id="account_section" class="" wire:ignore>
                                        <div class="flex items-center justify-between space-x-3 w-full">
                                            <div class="w-2/3 lg:w-3/4">
                                                <input type="text" wire:model.lazy="account_number"
                                                    class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#1F262C] text-xs lg:text-base font-Poppins font-semibold"
                                                    id="account_number"
                                                    placeholder="Enter your 10-digit account number">
                                                @error('account_number')
                                                    <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="">
                                                <button type="button"
                                                    class="bg-red-600 text-white px-8 py-2 lg:py-3 rounded-lg text-xs lg:text-base font-semibold"
                                                    wire:click.prevent="verifyAccount">
                                                    Verify
                                                    <span wire:loading wire:target="verifyAccount">
                                                        <i class="fas fa-spinner fa-spin"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                                    <div class="w-full">
                                        <label for="firstname" class="block font-semibold text-white mb-2 text-xs">First
                                            Name
                                            <span class="text-red-400">*</span></label>
                                        <input type="text" wire:model.lazy="firstname"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#1F262C] text-xs lg:text-base font-Poppins font-semibold"
                                            id="firstname">
                                        @error('firstname')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="w-full">
                                        <label for="lastname" class="block font-semibold text-white mb-2 text-xs">Last
                                            Name
                                            <span class="text-red-400">*</span></label>
                                        <input type="text" wire:model.lazy="lastname"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#1F262C] text-xs lg:text-base font-Poppins font-semibold"
                                            id="lastname">
                                        @error('lastname')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="w-full mb-2">
                                    <label for="middlename" class="block font-semibold text-white mb-2 text-xs">Middle
                                        Name</label>
                                    <input type="text" wire:model.lazy="middlename"
                                        class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#1F262C] text-xs lg:text-base font-Poppins font-semibold"
                                        id="middlename">
                                    @error('middlename')
                                        <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                                    <div class="w-full">
                                        <label for="email" class="block font-semibold text-white mb-2 text-xs">Email
                                            Address
                                            <span class="text-red-400">*</span></label>
                                        <input type="text" wire:model.lazy="email"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#1F262C] text-xs lg:text-base font-Poppins font-semibold"
                                            id="email">
                                        @error('email')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="w-full">
                                        <label for="phone" class="block font-semibold text-white mb-2 text-xs">Phone
                                            <span class="text-red-400">*</span></label>
                                        <x-tel-input wire:model.lazy="phone" id="phone" name="phone"
                                            class="form-input w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#1F262C] text-xs lg:text-base font-Poppins focus:font-semibold" />
                                        @error('phone')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="w-full mb-2 clear-both" id="select-class">
                                    <label for="interests"
                                        class="w-full block font-semibold mb-2 text-white text-xs">Area
                                        of Interest <br>
                                        <small class="text-white font-light">Please select what areas of tech you are
                                            involved or interested in. You can select more than one</small>
                                    </label>
                                    <x-simple-select wire:model="interests" name="interests" id="interests"
                                        :options="$area_of_interests" value-field='' text-field='' placeholder=""
                                        search-input-placeholder="Search..." :searchable="true" :multiple="true"
                                        class="form-select font-Poppins font-semibold" />

                                    @error('interests')
                                        <p class="text-red-600 font-bold">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="" class="block font-semibold text-white mb-2 text-xs">Social
                                        Media<br>
                                        <small class="text-white font-light">Let's get to know you. Add one or more
                                            of your social media handles.</small>
                                    </label>

                                    <div class="flex justify-between items-center space-x-5 mb-5">
                                        <div class="w-full">
                                            <select wire:model.defer="platform.0"
                                                class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69]  bg-white text-xs lg:text-base font-Poppins font-semibold">
                                                <option value=""></option>
                                                <option value="facebook">Facebook</option>
                                                <option value="linkedin">LinkedIn</option>
                                                <option value="instagram">Instagram</option>
                                                <option value="twitter">Twitter</option>
                                            </select>
                                            @error('platform.0')
                                                <p class="text-red-600 font-semibold text-xs text-left">{{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div class="w-full">
                                            <input type="text" wire:model.defer="handle.0"
                                                class="w-full block rounded-lg px-4 py-3 border border-[#ccd1d9] outline-none text-xs lg:text-base font-Poppins focus:font-semibold"
                                                placeholder="@johndoe">
                                            @error('handle.0')
                                                <p class="text-red-600 font-semibold text-xs text-left">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <button type="button"
                                            class="py-2 lg:py-3 px-4 lg:px-6 rounded bg-red-600 text-white font-medium shadow-sm"
                                            wire:click.prevent="add({{ $i }})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                    @foreach ($inputs as $key => $value)
                                        <div class="flex justify-between items-center space-x-5 mb-4">
                                            <div class="w-full">
                                                <select wire:model.defer="platform.{{ $value }}"
                                                    id="platform{{ $key }}"
                                                    class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white text-xs lg:text-base font-Poppins font-semibold">
                                                    <option value=""></option>
                                                    <option value="facebook">Facebook</option>
                                                    <option value="linkedin">LinkedIn</option>
                                                    <option value="instagram">Instagram</option>
                                                    <option value="twitter">Twitter</option>
                                                </select>
                                                @error('platform.*')
                                                    <p class="text-red-600 font-semibold text-xs text-right">
                                                        {{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="w-full">
                                                <input type="text" wire:model.defer="handle.{{ $value }}"
                                                    id="handle{{ $key }}"
                                                    class="w-full block rounded-lg px-4 py-3 border border-[#ccd1d9] outline-none text-xs lg:text-base font-Poppins focus:font-semibold"
                                                    placeholder="@johndoe">
                                                @error('handle.*')
                                                    <p class="text-red-600 font-semibold text-xs text-right">
                                                        {{ $message }}</p>
                                                @enderror
                                            </div>

                                            <button type="button"
                                                class="py-2 lg:py-3 px-4 lg:px-6 rounded bg-red-600 text-white font-semibold shadow-sm text-xs lg:text-base"
                                                wire:click.prevent="remove({{ $key + 1 }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="w-full relative">
                                    <label for="" class="block font-semibold text-white mb-4 text-xs">Would
                                        you
                                        like to attend our MasterClass?<br>
                                        <small class="text-white font-light">Sign up for any of our MasterClass
                                            sessions with leading tech industry experts from different fields.</small>
                                    </label>
                                    <div class="flex justify-between items-center space-x-5 mb-5">
                                        <div class="w-full">
                                            <select wire:model.defer="c_session.0" id="c_session"
                                                class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white c_session text-xs lg:text-base font-Poppins font-semibold">
                                                <option value=""></option>
                                                @foreach ($super_sessions as $key => $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="w-full">
                                            <select wire:model.defer="event_date.0" id="event_date"
                                                class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white text-xs lg:text-base font-Poppins font-semibold">
                                                <option value=""></option>
                                                @foreach ($events_date as $date_)
                                                    <option value="{{ $date_ }}">{{ $date_ }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="w-full">
                                            <select wire:model.defer="event_time.0" id="event_time"
                                                class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white text-xs lg:text-base font-Poppins font-semibold">
                                                <option value=""></option>
                                                @foreach ($events_time as $time_)
                                                    <option value="{{ $time_ }}">{{ $time_ }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="button"
                                            class="py-2 lg:py-3 px-4 lg:px-6 rounded bg-red-600 text-white font-medium shadow-sm"
                                            wire:click.prevent="addMore({{ $s }})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                    @foreach ($class_session_inputs as $keyy => $value)
                                        <div class="flex justify-between items-center space-x-5 mb-4">
                                            <div class="w-full">
                                                <select wire:model.defer="c_session.{{ $value }}"
                                                    id="c_session{{ $keyy }}"
                                                    class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white c_session text-xs lg:text-base font-Poppins font-semibold">
                                                    <option value=""></option>
                                                    @foreach ($super_sessions as $item_)
                                                        <option value="{{ $item_->id }}">{{ $item_->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="w-full">
                                                <select wire:model.defer="event_date.{{ $value }}"
                                                    id="event_date{{ $keyy }}"
                                                    class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white text-xs lg:text-base font-Poppins font-semibold">
                                                    <option value=""></option>
                                                    @foreach ($events_date as $date_item)
                                                        <option value="{{ $date_item }}">{{ $date_item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="w-full">
                                                <select wire:model.defer="event_time.{{ $value }}"
                                                    id="event_time{{ $keyy }}"
                                                    class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white text-xs lg:text-base font-Poppins font-semibold">
                                                    <option value=""></option>
                                                    @foreach ($events_time as $time_item)
                                                        <option value="{{ $time_item }}">{{ $time_item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="button"
                                                class="py-2 lg:py-3 px-4 lg:px-6 rounded bg-red-600 text-white font-semibold shadow-sm"
                                                wire:click.prevent="delete({{ $keyy + 1 }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                                <div
                                    class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2 clear-both">
                                    <div class="w-full">
                                        <label for="job_function"
                                            class="block font-semibold text-white mb-2 text-xs">Job Function
                                            <br><small class="text-white font-light">What is your current job
                                                function/role?</small>
                                        </label>
                                        <select wire:model.defer="job_function" id="job_function"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#1F262C] text-xs lg:text-base font-Poppins font-semibold">
                                            <option value=""></option>
                                            @foreach ($job_functions as $jb)
                                                <option value="{{ $jb }}">{{ $jb }}</option>
                                            @endforeach
                                        </select>
                                        @error('job_function')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="w-full">
                                        <label for="sector"
                                            class="block font-semibold text-white mb-2 text-xs">Sector
                                            <br>
                                            <small class="text-white font-light">What sector/industry, do you
                                                operate in?</small>
                                        </label>
                                        <select wire:model.defer="sector" id="sector"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#1F262C] text-xs lg:text-base font-Poppins font-semibold">
                                            <option value=""></option>
                                            @foreach ($sectors as $sect)
                                                <option value="{{ $sect }}">{{ $sect }}</option>
                                            @endforeach
                                        </select>
                                        @error('sector')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="w-full relative clear-both mb-4">
                                    <label for="" class="block font-semibold text-white mb-4 text-xs">Reason
                                        for
                                        attending this event <span class="text-red-400">*</span>
                                        <br>
                                        <small class="text-white font-light">Why would you be attending the Zenith
                                            Tech Fair 2023?</small>
                                    </label>
                                    <select wire:model.defer="reason" id="reason"
                                        class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#1F262C] text-xs lg:text-base font-Poppins font-semibold">
                                        <option value=""></option>
                                        <option value="Source products/services">Source products/services</option>
                                        <option value="Attend workshops/conferences">Attend workshops/conferences
                                        </option>
                                        <option value="Network with partners, clients and suppliers">Network with
                                            partners, clients and suppliers</option>
                                        <option value="Evaluate exhibiting opportunities">Evaluate exhibiting
                                            opportunities</option>
                                        <option value="Keep an eye on my competitors">Keep an eye on my competitors
                                        </option>
                                        <option value="Learn about the latest industry trends">Learn about the latest
                                            industry trends</option>
                                        <option value="Find startups to invest in">Find startups to invest in</option>
                                    </select>
                                    @error('reason')
                                        <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="w-full mb-4">
                                    <p
                                        class="py-2 border border-dashed px-4 bg-gray-100 rounded-lg text-xs mb-2 font-semibold font-Poppins">
                                        Zenith Bank is committed to the highest data privacy standards at all times and
                                        will only use the personal information you have provided for the purpose of this
                                        Tech Fair, update you periodically about our products, services, promo offerings
                                        and other information that may be of interest to you.</p>

                                    <label for="" class="block font-semibold text-white mb-4 text-xs">Please
                                        confirm your
                                        consent to collecting your personal information and receiving such messages<span
                                            class="text-red-400">*</span>
                                    </label>

                                    <select wire:model.defer="consent" id="consent"
                                        class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#1F262C] text-xs lg:text-base font-Poppins font-semibold">
                                        <option value=""></option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>

                                <div class="lg:text-right mx-auto">
                                    <button type="submit"
                                        class="bg-red-600 text-white px-8 py-3 rounded w-full lg:w-1/4 text-xs lg:text-base font-semibold">
                                        Submit
                                        <span wire:loading wire:target="bookSummit">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="max-w-3xl px-4 lg:px-16 mx-auto">
            <div class="grid h-screen place-items-center my-auto">
                <div class="py-4 text-white">
                    <div class="text-center mb-4">
                        <h6 class="text-4xl lg:text-4xl mb-2 font-semibold">Success</h6>
                    </div>
                    <div class="text-center px-6 lg:px-8 space-y-5">
                        <p class="font-normal mb-2 text-xs lg:text-sm opacity-80">Your registration is successful for
                            the Zenith Tech Fair 2023. We have sent an confirmation to the email you provided during
                            registration. It should arrive in a couple of minutes
                        </p>
                        <button wire:click="$set('success', false)"
                            class="bg-red-600 text-white px-8 py-2 lg:py-2.5 rounded w-full lg:w-1/4 text-xs lg:text-base font-semibold">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@section('scripts')
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#account_section').hide();

        $(document).on('change', '.c_session', function() {
            var val = $('option:selected', this).val()
            Livewire.emit('class_selected', val);
        });

        window.addEventListener('DOMContentLoaded', event => {

            $('#have_an_account').on('change', function(event) {
                let selected = $(this).val();
                if (selected == "yes") {
                    $('#account_section').show();
                } else {
                    $('#account_section').hide();
                }
            })

        });
    </script>
@endsection
