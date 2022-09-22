@section('title', 'Zenith Tech Fair::Welcome')
@section('styles')
    <link href="/assets/css/select2.min.css" rel="stylesheet" />
@endsection
<div class="py-4 lg:py-8">
    <div class="text-center mx-auto border-b border-gray-100">
        <div class="mb-4">
            <img src="/assets/images/zfair-logo.png" alt="" class="mx-auto">
        </div>
    </div>
    <div class="max-w-3xl px-4 mx-auto">
        <div class="grid grid-cols-1">
            <div class="py-8 px-4 lg:px-8">
                @if ($step_one)
                    <div>
                        <form method="POST" wire:submit.prevent="nextStepLogic">
                            {{ csrf_field() }}
                            <div class="py-4">
                                <div class="space-y-5 mb-2">
                                    <div class="w-full">
                                        <label for="have_an_account" class="block font-semibold text-[#544837] mb-2">Do
                                            you
                                            have a
                                            zenith
                                            account?
                                            <span class="text-red-400">*</span></label>
                                        <select wire:model.lazy="have_an_account" id="have_an_account"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                            <option value="">Choose One...</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        @error('have_an_account')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div id="account_section" class="{{ $show_account_section ? '' : 'hidden' }}">
                                        <div class="flex items-center justify-between space-x-3 w-full">
                                            <div class="w-2/3 lg:w-3/4">
                                                <input type="text" wire:model.lazy="account_number"
                                                    class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                                    id="account_number"
                                                    placeholder="Enter your 10-digit account number">
                                                @error('account_number')
                                                    <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="">
                                                <button type="button"
                                                    class="bg-red-600 text-white px-8 py-3 rounded-lg border border-[#ccd1d9]"
                                                    wire:click.prevent="verifyAccount">
                                                    Verify
                                                    <i class="fas fa-spinner fa-spin" wire:loading
                                                        wire:target="verifyAccount"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                                    <div class="w-full">
                                        <label for="firstname" class="block font-semibold text-[#544837] mb-2">First
                                            Name
                                            <span class="text-red-400">*</span></label>
                                        <input type="text" wire:model.lazy="firstname"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                            id="firstname">
                                        @error('firstname')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="w-full">
                                        <label for="lastname" class="block font-semibold text-[#544837] mb-2">Last Name
                                            <span class="text-red-400">*</span></label>
                                        <input type="text" wire:model.lazy="lastname"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                            id="lastname">
                                        @error('lastname')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                                    <div class="w-full">
                                        <label for="email" class="block font-semibold text-[#544837] mb-2">Email
                                            Address
                                            <span class="text-red-400">*</span></label>
                                        <input type="text" wire:model.lazy="email"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                            id="email">
                                        @error('email')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="w-full">
                                        <label for="phone" class="block font-semibold text-[#544837] mb-2">Phone
                                            <span class="text-red-400">*</span></label>
                                        <input type="text" wire:model.lazy="phone"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                            id="phone">
                                        @error('phone')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="w-full mb-2 clear-both" id="select-class">
                                    <label for="" class="w-full block font-semibold mb-2 text-[#544837]">Area
                                        of Interest</label>
                                    <div wire:ignore>
                                        <select wire:model="interests"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970] js-example-basic-multiple appearance-none"
                                            multiple="multiple">
                                            @foreach ($area_of_interests as $aoi)
                                                <option value="{{ $aoi }}">{{ $aoi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('interests')
                                        <p class="text-red-600 font-bold">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="" class="block font-semibold text-[#544837] mb-2">Social
                                        Media</label>

                                    <div class="flex justify-between items-center space-x-5 mb-5">
                                        <div class="w-full">
                                            <select wire:model.defer="platform.0"
                                                class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white">
                                                <option value="">Choose One...</option>
                                                <option value="facebook">Facebook</option>
                                                <option value="linkedin">LinkedIn</option>
                                                <option value="instagram">Instagram</option>
                                            </select>
                                            @error('platform.0')
                                                <p class="text-red-600 font-semibold text-xs text-left">{{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div class="w-full">
                                            <input type="text" wire:model.defer="handle.0"
                                                class="w-full block rounded-lg px-4 py-3 border border-[#ccd1d9] outline-none"
                                                placeholder="e.g @ john doe">
                                            @error('handle.0')
                                                <p class="text-red-600 font-semibold text-xs text-left">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <button type="button"
                                            class="py-2 lg:py-3 px-4 lg:px-6 rounded bg-green-600 text-white font-semibold shadow-sm"
                                            wire:click.prevent="add({{ $i }})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                    @foreach ($inputs as $key => $value)
                                        <div class="flex justify-between items-center space-x-5 mb-4">
                                            <div class="w-full">
                                                <select wire:model.defer="platform.{{ $value }}"
                                                    id="platform{{ $key }}"
                                                    class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white">
                                                    <option value="">Choose One...</option>
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
                                                    class="w-full block rounded-lg px-4 py-3 border border-[#ccd1d9] outline-none"
                                                    placeholder="e.g @ john doe">
                                                @error('handle.*')
                                                    <p class="text-red-600 font-semibold text-xs text-right">
                                                        {{ $message }}</p>
                                                @enderror
                                            </div>

                                            <button type="button"
                                                class="py-2 lg:py-3 px-4 lg:px-6 rounded bg-red-600 text-white font-semibold shadow-sm"
                                                wire:click.prevent="remove({{ $key }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                            <div class="">
                                <button type="submit"
                                    class="bg-red-600 text-white px-8 py-3 rounded w-full lg:w-1/4 uppercase">
                                    Next
                                    <i class="fas fa-spinner fa-spin" wire:loading wire:target="nextStepLogic"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                @if ($step_two)
                    <div>
                        <form method="POST" wire:submit.prevent="bookSummit">
                            {{ csrf_field() }}
                            <div class="py-4">
                                @php
                                    $events_date = $super_sessions->first()->event_date;
                                    $events_time = $super_sessions->first()->event_time;
                                @endphp
                                <div class="w-full relative">
                                    <label for="" class="block font-semibold text-[#544837] mb-4">Would you
                                        like to attend our Masterclass?
                                        <span class="text-red-400">*</span></label>
                                    <div class="flex justify-between items-center space-x-5 mb-5">
                                        <div class="w-full">
                                            <select wire:model.defer="c_session.0" id="c_session"
                                                class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white">
                                                <option value="">Choose One...</option>
                                                @foreach ($super_sessions as $key => $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="w-full">
                                            <select wire:model.defer="event_date.0" id="event_date"
                                                class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white">
                                                <option value="">Choose Date...</option>
                                                @foreach ($events_date as $date_)
                                                    <option value="{{ $date_ }}">{{ $date_ }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="w-full">
                                            <select wire:model.defer="event_time.0" id="event_time"
                                                class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white">
                                                <option value="">Choose Time...</option>
                                                @foreach ($events_time as $time_)
                                                    <option value="{{ $time_ }}">{{ $time_ }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="button"
                                            class="py-2 lg:py-3 px-4 lg:px-6 rounded bg-green-600 text-white font-semibold shadow-sm"
                                            wire:click.prevent="addMore({{ $s }})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                    @foreach ($class_session_inputs as $keyy => $value)
                                        <div class="flex justify-between items-center space-x-5 mb-4">
                                            <div class="w-full">
                                                <select wire:model.defer="c_session.{{ $value }}"
                                                    id="c_session{{ $keyy }}"
                                                    class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white">
                                                    <option value="">Choose One...</option>
                                                    @foreach ($super_sessions as $item_)
                                                        <option value="{{ $item_->id }}">{{ $item_->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="w-full">
                                                <select wire:model.defer="event_date.{{ $value }}"
                                                    id="event_date{{ $keyy }}"
                                                    class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white">
                                                    <option value="">Choose Date...</option>
                                                    @foreach ($events_date as $date_item)
                                                        <option value="{{ $date_item }}">{{ $date_item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="w-full">
                                                <select wire:model.defer="event_time.{{ $value }}"
                                                    id="event_time{{ $keyy }}"
                                                    class="w-full block border-[#ccd1d9] py-3 px-4 transition-all rounded-lg focus:border-[#193B69] bg-white">
                                                    <option value="">Choose Time...</option>
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
                                        <label for="role" class="block font-semibold text-[#544837] mb-2">Role
                                            <span class="text-red-400">*</span></label>
                                        <select wire:model.defer="role" id="role"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                            <option value="">Choose One...</option>
                                            <option value="student">Student</option>
                                            <option value="freelancer">Freelancer</option>
                                            <option value="employee">Employee</option>
                                            <option value="business owner">Business Owner</option>
                                        </select>
                                        @error('role')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="w-full">
                                        <label for="sector" class="block font-semibold text-[#544837] mb-2">Sector
                                            <span class="text-red-400">*</span></label>
                                        <select wire:model.defer="sector" id="sector"
                                            class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                            <option value="">Choose One...</option>
                                            @foreach ($sectors as $sect)
                                                <option value="{{ $sect }}">{{ $sect }}</option>
                                            @endforeach
                                        </select>
                                        @error('sector')
                                            <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>

                                <div class="w-full relative clear-both">
                                    <label for="" class="block font-semibold text-[#544837] mb-4">Reason for
                                        attending this event</label>
                                    <select wire:model.defer="reason" id="reason"
                                        class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                        <option value="">Choose One...</option>
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

                            </div>

                            <div class="flex items-center justify-between space-x-3">
                                <a href="#"
                                    class="bg-red-600 text-white px-8 py-3 rounded w-full lg:w-1/4 text-center"
                                    wire:click.prevent="goBack">
                                    Prev
                                </a>

                                <button type="submit"
                                    class="bg-red-600 text-white px-8 py-3 rounded w-full lg:w-1/4">
                                    Submit
                                    <i class="fas fa-spinner fa-spin" wire:loading wire:target="bookSummit"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        @if ($final_step)
            <div class="flex flex-col h-screen">
                <div class="grid grid-cols-1 place-items-center w-full my-auto">
                    <div class="bg-white border border-gray-100 shadow-lg py-4 rounded-2xl">
                        <div class="mb-5 py-4">
                            <div class="text-center mb-4">
                                <h6 class="text-2xl mb-2 font-semibold">Registration Successful</h6>
                            </div>
                            <div class="text-center mb-4">
                                <img src="{{ $qr_code_url }}" alt="" srcset="" class="mx-auto w-1/2">
                                {{-- <h1 class="font-semibold text-2xl">{{ $token }}</h1>
                            <a href="javascript:void(0)" onclick="copyCode({{ json_encode($token) }})"
                                class="py-2 px-4 text-sm text-gray-700 border border-gray-300 rounded-lg">
                                <i class="fas fa-copy"></i>
                            </a> --}}
                            </div>
                            <div class="text-center px-6 lg:px-8">
                                <p class="text-[#4F596A] font-medium mb-4">Hey <strong>{{ $firstname }}</strong>,
                                    thank
                                    you for registering for the Zenith Tech Fair.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@section('scripts')
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/select2.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            $('.js-example-basic-multiple').select2();

            $('.js-example-basic-multiple').on('change', function(event) {
                let data = $(this).val();
                @this.set('interests', data);
            });
        });

        window.addEventListener("livewire:load", () => {
            Livewire.hook('message.processed', (message, component) => {
                $('.js-example-basic-multiple').select2()
            });
        });
    </script>
@endsection
